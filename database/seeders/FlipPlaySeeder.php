<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlipPlaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Alya',
                'password' => bcrypt('password'),
            ]
        );

        $media = [
            [
                'title' => 'One Piece',
                'type' => 'Anime',
                'genre' => 'Petualangan',
                'release_year' => 1999,
                'vibe' => 'High Energy',
            ],
            [
                'title' => 'Frieren: Beyond Journey’s End',
                'type' => 'Anime',
                'genre' => 'Fantasi',
                'release_year' => 2023,
                'vibe' => 'Melancholy',
            ],
            [
                'title' => 'Spy x Family',
                'type' => 'Anime',
                'genre' => 'Komedi',
                'release_year' => 2022,
                'vibe' => 'Chill Vibe',
            ],
        ];

        foreach ($media as $attributes) {
            Media::query()->firstOrCreate(
                ['title' => $attributes['title'], 'type' => $attributes['type']],
                $attributes
            );
        }

        $user->media()->syncWithoutDetaching(
            Media::query()->whereIn('title', ['One Piece', 'Frieren: Beyond Journey’s End'])->pluck('id')
        );
    }
}
