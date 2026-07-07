<?php

namespace Cable8mm\WaterMelon\Tests;

use Cable8mm\WaterMelon\MelonArtist;
use Cable8mm\WaterMelon\Resources\ArtistNullResource;
use PHPUnit\Framework\TestCase;

/**
 * @group online
 */
final class ArtistNullResourceTest extends TestCase
{
    public function test_artist_null_resource_returns_null_for_default_images(): void
    {
        $artist = MelonArtist::make(3114174);
        $resource = ArtistNullResource::make($artist);

        $featuredImagePath = $resource->getFeaturedImagePath();
        $profileImagePath = $resource->getProfileImagePath();

        if ($featuredImagePath !== null) {
            $this->assertStringStartsWith('https://', $featuredImagePath);
        }
        if ($profileImagePath !== null) {
            $this->assertStringStartsWith('https://', $profileImagePath);
        }
    }

    public function test_artist_null_resource_has_required_methods(): void
    {
        $artist = MelonArtist::make(3114174);
        $resource = ArtistNullResource::make($artist);

        $this->assertIsCallable([$resource, 'toArray']);
        $this->assertIsCallable([$resource, 'getMelonArtistId']);
        $this->assertIsCallable([$resource, 'getName']);
        $this->assertIsCallable([$resource, 'getFeaturedImagePath']);
        $this->assertIsCallable([$resource, 'getProfileImagePath']);
        $this->assertIsCallable([$resource, 'getDebut']);
    }

    public function test_artist_null_resource_to_array(): void
    {
        $artist = MelonArtist::make(3114174);
        $resource = ArtistNullResource::make($artist);

        $array = $resource->toArray();

        $this->assertArrayHasKey('melon_artistid', $array);
        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('featured_image_path', $array);
        $this->assertArrayHasKey('profile_image_path', $array);
        $this->assertArrayHasKey('debut', $array);
    }
}
