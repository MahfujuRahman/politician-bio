<?php
namespace App\Modules\Management\EventManagement\Event\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\EventManagement\Event\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\EventManagement\Event\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([
                'banner_image'      => 'uploads/default.jpg',
                'date_time'         => $faker->dateTime,
                'place_address'     => $faker->text(200),
                'title'             => $faker->text(100),
                'short_description' => $faker->paragraph,
                'description'       => $faker->text,
                'location_link'     => $faker->text(250),
            ]);
        }
    }
}