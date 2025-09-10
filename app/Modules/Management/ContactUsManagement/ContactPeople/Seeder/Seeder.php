<?php
namespace App\Modules\Management\ContactUsManagement\ContactPeople\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\ContactUsManagement\ContactPeople\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\ContactUsManagement\ContactPeople\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'first_name' => $faker->text(50),
                'last_name' => $faker->text(50),
                'email' => $faker->text(50),
                'phone_number' => $faker->text(20),
                'subject' => $faker->text(100),
                'address' => $faker->text(200),
            ]);
        }
    }
}