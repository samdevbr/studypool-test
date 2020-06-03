<?php
namespace App;

require_once ("./bootstrap.php");

function execute(string $name, string $query, ...$args)
{
    global $connection;

    $start = microtime(true);

    $stmt = $connection->prepare($query);
    $stmt->execute($args);

    $elapsed = microtime(true) - $start;

    echo "---------------------------" . PHP_EOL;
    echo "$name query" . PHP_EOL;
    echo "Took $elapsed microseconds to run" . PHP_EOL;
    echo "---------------------------" . PHP_EOL;
    echo PHP_EOL;
}

execute(
    "All users of January, 2020",
    "SELECT * FROM `tbl_users` WHERE create_time BETWEEN ? AND ?",
    (\DateTime::createFromFormat("Y-m-d H:i", "2020-01-01 00:00"))->getTimestamp(),
    (\DateTime::createFromFormat("Y-m-d H:i", "2020-01-31 23:59"))->getTimestamp(),
);

execute(
    "How many questions each user posted",
    "SELECT user_id as id, tbl_users.username, COUNT(user_id) as total_questions FROM tbl_questions
     JOIN tbl_users ON (user_id = tbl_users.id)
     GROUP BY user_id
     ORDER BY user_id",
);

execute(
    "Questions that don't have bids",
    "SELECT tbl_questions.id, tbl_questions.user_id, tbl_users.username, tbl_questions.create_time FROM tbl_questions
    JOIN tbl_users ON (tbl_questions.user_id = tbl_users.id)
    LEFT OUTER JOIN tbl_bids ON (tbl_questions.id = tbl_bids.question_id_id)
    WHERE tbl_bids.question_id_id IS NULL ORDER BY tbl_questions.id",
);

$tutorType = 2;

execute(
    "Tutors who were created in the last 30 days but haven't posted any bids yet",
    "SELECT tbl_users.id, username, tbl_users.create_time FROM `tbl_users`
    LEFT OUTER JOIN tbl_bids ON (tbl_users.id = tbl_bids.user_id)
    WHERE tbl_bids.user_id IS NULL AND user_type = ? AND
    tbl_users.create_time BETWEEN ? AND ?",
    $tutorType,
    (new \DateTime('-30 days'))->getTimestamp(),
    (new \DateTime('today'))->getTimestamp(),
);

execute(
    "List of total questions and total bids posted per month",
    "SELECT SUM(total_bids) as total_bids, SUM(total_questions) as total_questions, date FROM (
        SELECT
            0 as total_bids,
            COUNT(Q.id) as total_questions,
            DATE_FORMAT(FROM_UNIXTIME(MIN(Q.create_time)), \"%Y-%m-%d\") as date
            FROM tbl_questions as Q
            GROUP BY EXTRACT(YEAR_MONTH FROM FROM_UNIXTIME(Q.create_time))

        UNION ALL

        SELECT
            COUNT(B.id) as total_bids,
            0 as total_questions,
            DATE_FORMAT(FROM_UNIXTIME(MIN(B.create_time)), \"%Y-%m-%d\") as date
            FROM tbl_bids as B GROUP BY EXTRACT(YEAR_MONTH FROM FROM_UNIXTIME(B.create_time))
        ) AS R GROUP BY date",
);
