<?php

namespace App;

use Faker\Factory;

require_once("./bootstrap.php");

$faker = Factory::create();

function createUsers(int $amount)
{
    global $connection, $faker;

    echo "Creating $amount users..." . PHP_EOL;

    for ($i = 0; $i < $amount; $i++) {
        $stmt = $connection->prepare("INSERT INTO tbl_users (create_time, username, user_type) VALUES (?, ?, ?)");
        $stmt->execute([
            $faker->unixTime,
            $faker->userName,
            $faker->randomElement([1, 2])
        ]);
    }
}

createUsers(5000);

function createQuestions(int $amount)
{
    global $connection, $faker;

    echo "Creating $amount questions..." . PHP_EOL;

    for ($i = 0; $i < $amount; $i++) {
        $stmt = $connection->prepare("INSERT INTO tbl_questions (create_time, `user_id`) VALUES (?, ?)");

        $stmt->execute([
            $faker->unixTime,
            $faker->numberBetween(1, 5000)
        ]);
    }
}

createQuestions(5000);

function createBids(int $amount)
{
    global $connection, $faker;

    echo "Creating $amount bids..." . PHP_EOL;

    for ($i = 0; $i < $amount; $i++) {
        $stmt = $connection->prepare("INSERT INTO tbl_bids (create_time, question_id_id, `user_id`, price) VALUES (?, ?, ?, ?)");

        $stmt->execute([
            $faker->unixTime,
            $faker->numberBetween(1, 5000),
            $faker->numberBetween(1, 5000),
            $faker->numberBetween(1, 20),
        ]);
    }
}

createBids(5000);
