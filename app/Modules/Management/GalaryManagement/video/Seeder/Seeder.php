<?php
namespace App\Modules\Management\GalaryManagement\video\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\GalaryManagement\video\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\GalaryManagement\video\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'title' => $faker->text(50),
                'video_url' => $faker->text(200),
                'gallery_category_id' => null,
            ]);
        }
    }
}