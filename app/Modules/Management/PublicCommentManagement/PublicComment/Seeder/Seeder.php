<?php
namespace App\Modules\Management\PublicCommentManagement\PublicComment\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\PublicCommentManagement\PublicComment\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\PublicCommentManagement\PublicComment\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'comment' => $faker->text,
                'name' => $faker->text(50),
                'commenter_image' => null,
            ]);
        }
    }
}