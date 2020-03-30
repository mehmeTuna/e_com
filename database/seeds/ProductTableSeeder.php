<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($a = 0 ; $a<100 ; $a++)
        {
            DB::table('product')->insert([
                'price' => rand(1,9).''.rand(0,9).'.99',
                'description' =>  $faker->text,
                'name' => $faker->domainWord ,
                'card_text' => $faker->text,
                'img' => '/public/img/1010a-3463-2_urun_g2711_k_O3qXrtH7.jpg',
                'categoryId' => 0,
                'images' => json_encode([
                    [
                        'url' => '/public/img/1010a-3463-2_urun_g2711_k_O3qXrtH7.jpg'
                    ],
                    [
                        'url' => '/public/img/1010a-3463-2_urun_g2711_k_O3qXrtH7.jpg'
                    ],
                    [
                        'url' => '/public/img/1010a-3463-2_urun_g2711_k_O3qXrtH7.jpg'
                    ],
                    [
                        'url' => '/public/img/1010a-3463-2_urun_g2711_k_O3qXrtH7.jpg'
                    ]
                ])
            ]);
        }
    }
}
