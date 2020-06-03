Samuel Studypool Test
===============

## Configuring PHP Test

After you've cloned this repo, follow below steps in order to setup composer class mapping for the PHP Class test.

1. `cd php`
2. `composer dumpautoload`
3. `php src/index.php`

>The actual, test implementation lies inside /path/to/repo/php/src folder.

## Configuring MySQL Test

>Quick note: I've changed the schema by adding some indexes and FK's, the new schema lies at `path/to/repo/mysql/new_schema.sql`

For this test I've created a faker file to populate the tables, it's not required to be ran in order to use the queries, which lies in `/path/to/repo/mysql/src/index.php`.

The only required steps for this test is installing the composer dependencies, and .env configuration, follow below steps to setup.

1. `cd mysql`
2. `composer install`
3. `cp .env.example .env`
4. `php src/faker.php` (optional)
5. `php src/index.php`

>In .env file change the constants to the actual values for your environment

## Done!