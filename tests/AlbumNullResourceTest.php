<?php

namespace Cable8mm\WaterMelon\Tests;

use Cable8mm\WaterMelon\MelonAlbum;
use Cable8mm\WaterMelon\Resources\AlbumNullResource;
use PHPUnit\Framework\TestCase;

/**
 * @group online
 */
final class AlbumNullResourceTest extends TestCase
{
    public function test_album_null_resource_returns_null_for_default_image(): void
    {
        $album = MelonAlbum::make(11127145);
        $resource = AlbumNullResource::make($album);

        $albumCoverPath = $resource->getAlbumCoverPath();

        if ($albumCoverPath !== null) {
            $this->assertStringStartsWith('https://', $albumCoverPath);
        }
    }

    public function test_album_null_resource_has_required_methods(): void
    {
        $album = MelonAlbum::make(11127145);
        $resource = AlbumNullResource::make($album);

        $this->assertIsCallable([$resource, 'toArray']);
        $this->assertIsCallable([$resource, 'getMelonAlbumId']);
        $this->assertIsCallable([$resource, 'getTitle']);
        $this->assertIsCallable([$resource, 'getAlbumCoverPath']);
        $this->assertIsCallable([$resource, 'getReleasedAt']);
    }

    public function test_album_null_resource_to_array(): void
    {
        $album = MelonAlbum::make(11127145);
        $resource = AlbumNullResource::make($album);

        $array = $resource->toArray();

        $this->assertArrayHasKey('melon_albumid', $array);
        $this->assertArrayHasKey('title', $array);
        $this->assertArrayHasKey('album_cover_path', $array);
        $this->assertArrayHasKey('released_at', $array);
    }
}
