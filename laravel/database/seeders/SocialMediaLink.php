<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SocialMediaLink as SocialMedia;
use Illuminate\Support\Str;

class SocialMediaLink extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            [
                'name'  => 'Facebook',
                'url'   => 'https://www.facebook.com/'
            ],
            [
                'name'  => 'Instagram',
                'url'   => 'https://www.instagram.com/'
            ],
            [
                'name'  => 'Twitter',
                'url'   => 'https://twitter.com/'
            ],
            [
                'name'  => 'LinkedIn',
                'url'   => 'https://www.linkedin.com/'
            ]
        ];
        foreach ($links as $data) {
            $name = $data['name'];
            $slug = Str::slug($name);
            SocialMedia::create([
                'name'          =>  $data['name'],
                'slug'          =>  $slug,
                'url'           =>  $data['url']
            ]);
        }
    }
}
