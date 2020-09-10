<?php

use Illuminate\Database\Seeder;
use App\post;
use Illuminate\Support\Str;
class posts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        post::create([
            'user_id' => '1',
            'body' => Str::random(10),
            'image' =>'https://placeimg.com/100/100/any?' . rand(1, 100),
        ]);

    }
}
