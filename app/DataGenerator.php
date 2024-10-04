<?php

declare(strict_types = 1);

// require_once __DIR__ . '/../vendor/autoload.php'; // Include the Composer autoloader

namespace App;


use App\Models\Transaction;
use DateTime;
use Faker\Factory;

class DataGenerator
{

    public static function generate(int $numRecords): void
    {
        $faker = Factory::create();

        $transaction = new Transaction();

        for ($i = 0; $i < $numRecords; $i++) {
            $transaction->create(
                new DateTime($faker->date()),
                $faker->randomNumber(5),
                $faker->sentence(),
                $faker->randomFloat(2, -1000, 1000),
                null
            );
        }
    }
}