<?php

namespace Tests\Feature;

use App\Models\Media;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MediaApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_media_list_can_be_filtered_by_title(): void
    {
        Media::create([
            'title' => 'Naruto',
            'type' => 'Anime',
            'genre' => 'Aksi',
            'release_year' => 2002,
        ]);

        $this->getJson('/api/media?title=Nar')
            ->assertOk()
            ->assertJsonFragment(['title' => 'Naruto']);
    }

    public function test_media_requires_title(): void
    {
        $this->postJson('/api/media', [
            'type' => 'Anime',
            'genre' => 'Aksi',
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['title']);
    }

    public function test_duplicate_media_title_for_same_type_is_rejected(): void
    {
        Media::create([
            'title' => 'Naruto',
            'type' => 'Anime',
            'genre' => 'Aksi',
        ]);

        $this->postJson('/api/media', [
            'title' => 'Naruto',
            'type' => 'Anime',
            'genre' => 'Aksi',
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['title']);
    }

    public function test_media_can_be_added_to_and_removed_from_user_collection(): void
    {
        $user = User::factory()->create();
        $media = Media::create([
            'title' => 'Frieren',
            'type' => 'Anime',
            'genre' => 'Fantasi',
        ]);

        $this->postJson("/api/users/{$user->id}/media/{$media->id}")
            ->assertCreated()
            ->assertJsonFragment(['title' => 'Frieren']);

        $this->postJson("/api/users/{$user->id}/media/{$media->id}")
            ->assertConflict();

        $this->getJson("/api/users/{$user->id}/media")
            ->assertOk()
            ->assertJsonFragment(['title' => 'Frieren']);

        $this->deleteJson("/api/users/{$user->id}/media/{$media->id}")
            ->assertOk();
    }
}
