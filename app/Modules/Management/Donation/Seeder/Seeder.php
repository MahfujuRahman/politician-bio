<?php
namespace App\Modules\Management\Donation\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\Donation\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\Donation\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'first_name' => $faker->sentence,
                'last_name' => $faker->sentence,
                'email' => $faker->sentence,
                'number' => $faker->sentence,
                'address_1' => $faker->sentence,
                'address_2' => $faker->sentence,
                'city' => $faker->sentence,
                'state' => $faker->sentence,
                'payment_method' => $faker->randomElement(array (
  0 => 'sslcommerze',
  1 => 'offline',
)),
                'amount' => $faker->randomFloat(2, 0, 1000),
            ]);
        }
    }
}