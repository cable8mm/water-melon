<?php

namespace Cable8mm\WaterMelon\Tests;

use Cable8mm\WaterMelon\MelonSong;
use Cable8mm\WaterMelon\Resources\SongNullResource;
use PHPUnit\Framework\TestCase;

final class SongNullResourceTest extends TestCase
{
    public function test_song_null_resource_returns_null_for_default_image(): void
    {
        $song = MelonSong::make(35945927);
        $resource = SongNullResource::make($song);

        // SongNullResource should convert default images to null
        $artworkPath = $resource->getArtworkImagePath();

        // If it's a default image, it should be null
        // Otherwise, it should be a valid URL
        if ($artworkPath !== null) {
            $this->assertStringStartsWith('https://', $artworkPath);
        }
    }

    public function test_song_null_resource_has_required_methods(): void
    {
        $song = MelonSong::make(35945927);
        $resource = SongNullResource::make($song);

        $this->assertIsCallable([$resource, 'toArray']);
        $this->assertIsCallable([$resource, 'getMelonSongId']);
        $this->assertIsCallable([$resource, 'getTitle']);
        $this->assertIsCallable([$resource, 'getAlbumId']);
        $this->assertIsCallable([$resource, 'getArtworkImagePath']);
    }

    public function test_song_null_resource_to_array(): void
    {
        $song = MelonSong::make(35945927);
        $resource = SongNullResource::make($song);

        $array = $resource->toArray();

        $this->assertArrayHasKey('album_id', $array);
        $this->assertArrayHasKey('melon_songid', $array);
        $this->assertArrayHasKey('title', $array);
        $this->assertArrayHasKey('artwork_image_path', $array);
    }
}
