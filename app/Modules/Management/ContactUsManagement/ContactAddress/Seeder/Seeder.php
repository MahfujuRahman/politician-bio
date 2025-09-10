<?php
namespace App\Modules\Management\ContactUsManagement\ContactAddress\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\ContactUsManagement\ContactAddress\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\ContactUsManagement\ContactAddress\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'icon' => $faker->text(30),
                'name' => $faker->text(100),
                'address' => $faker->text(200),
                'phone_number' => $faker->text(20),
                'email' => $faker->text(50),
                'map_link' => $faker->text(250),
            ]);
        }
    }
}