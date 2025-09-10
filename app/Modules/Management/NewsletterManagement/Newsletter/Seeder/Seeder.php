<?php
namespace App\Modules\Management\NewsletterManagement\Newsletter\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\NewsletterManagement\Newsletter\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\NewsletterManagement\Newsletter\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'email' => $faker->text(50),
            ]);
        }
    }
}