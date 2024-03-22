<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;
use Illuminate\Support\Str;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $game = [
            [
                'category_id'=> '2',
                'name' => 'Pummel A Politicians',
                'url'=>'https://iwin.aistechnolabs.co/public/pummel-the-politician/',
            ],
            [
                'category_id'=> '1' ,
                'name' => 'TiKiMATCH 3',
                'url'=>'https://iwin.aistechnolabs.co/public/tikimatch/',
            ],
            [
                'category_id'=> '1' ,
                'name' => 'ClownMatch 3',
                'url'=>'https://iwin.aistechnolabs.co/public/clown-match/',
            ],
            [
                'category_id'=> '3' ,
                'name' => 'DEAD CITY',
                'url'=>'https://iwin.aistechnolabs.co/public/dead-city/',
            ],
            [
                'category_id'=> '3' ,
                'name' => 'Handless millionaire',
                'url'=>'https://iwin.aistechnolabs.co/public/handless-millionaire/',
            ],
            [
                'category_id'=> '3' ,
                'name' => 'American Football',
                'url'=>'https://iwin.aistechnolabs.co/public/american-football/',
            ],
        ];
        foreach ($game as $value) {
            $name = $value['name'];
            $slug = Str::slug($name);
            Game::create([
                'category_id'=>  $value['category_id'],
                'slug'       =>  $slug,
                'name'       =>  $name,
                'url'        =>  $value['url'],
            ]);
        }
    }
}
