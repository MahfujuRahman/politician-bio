<?php
namespace App\Modules\Management\VolunteerManagement\VolunteerPreRequisite\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\VolunteerManagement\VolunteerPreRequisite\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\VolunteerManagement\VolunteerPreRequisite\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'title' => $faker->sentence,
                'option' => json_encode([$faker->word, $faker->word]),
            ]);
        }
    }
}