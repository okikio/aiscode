<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;
use Illuminate\Support\Str;

class GameSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $game = [
            [
                'category_id'=> '4',
                'name' => "3 hand CASINO HOLD'EM",
                'url'=>'https://slotcatalog.com/en/slots/3-Hand-Casino-HoldEm-Playn-Go?ajax=1&blck=demo-widget',
            ],
            [
                'category_id'=> '5',
                'name' => 'ANNIHILATOR',
                'url'=>'https://slotcatalog.com/en/slots/Annihilator?ajax=1&blck=demo-widget',
            ],
            [
                'category_id'=> '5',
                'name' => 'BLOOD SUCKERS',
                'url'=>'https://slotcatalog.com/en/slots/Blood-Suckers?ajax=1&blck=demo-widget',
            ],
            [
                'category_id'=> '5',
                'name' => 'OUTLAWS HUNTER',
                'url'=>'https://slotcatalog.com/en/slots/Outlaws-Hunter?ajax=1&blck=demo-widget',
            ],
            [
                'category_id'=> '5',
                'name' => 'FOLSOM PRISON',
                'url'=>'https://slotcatalog.com/en/slots/Folsom-Prison?ajax=1&blck=demo-widget',
            ],
            [
                'category_id'=> '5',
                'name' => 'West Coast Cash Infinity REELS',
                'url'=>'https://slotcatalog.com/en/slots/West-Coast-Cash-Infinity-Reels?ajax=1&blck=demo-widget',
            ],
            [
                'category_id'=> '4',
                'name' => 'MINI BACCARAT',
                'url'=>'https://slotcatalog.com/en/slots/Mini-Baccarat-Playn-Go?ajax=1&blck=demo-widget',
            ],
            [
                'category_id'=> '5',
                'name' => 'BEAST OF FIRE',
                'url'=>'https://slotcatalog.com/en/slots/Beasts-of-Fire?ajax=1&blck=demo-widget',
            ],
            [
                'category_id'=> '5',
                'name' => '3 CLOWN MONTY',
                'url'=>'https://slotcatalog.com/en/slots/3-Clown-Monty?ajax=1&blck=demo-widget',
            ],
            [
                'category_id'=> '4',
                'name' => 'Black Jack MH',
                'url'=>'https://slotcatalog.com/en/slots/Single-Deck-Blackjack-MH?ajax=1&blck=demo-widget',
            ],
            [
                'category_id'=> '4',
                'name' => 'HI LO SWITCH',
                'url'=>'https://slotcatalog.com/en/slots/Hi-Lo-Switch?ajax=1&blck=demo-widget',
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
