<?php
namespace App\Modules\Management\VolunteerManagement\VolunteerApplication\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\VolunteerManagement\VolunteerApplication\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\VolunteerManagement\VolunteerApplication\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'first_name' => $faker->text(50),
                'last_name' => $faker->text(50),
                'email' => $faker->text(50),
                'phone_number' => $faker->text(30),
                'help_types' => json_encode([$faker->word, $faker->word]),
                'time_slots' => json_encode([$faker->word, $faker->word]),
                'week_days' => json_encode([$faker->word, $faker->word]),
                'comment' => $faker->text,
            ]);
        }
    }
}