<?php

namespace Cable8mm\WaterMelon\Tests;

use Cable8mm\WaterMelon\MelonArtist;
use Cable8mm\WaterMelon\Resources\ArtistNullResource;
use PHPUnit\Framework\TestCase;

final class ArtistNullResourceTest extends TestCase
{
    // public function test_havnt_image_artist_resource()
    // {
    //     $melonArtist = MelonArtist::make(3102913);   // HEYA

    //     $artistResource = ArtistNullResource::make($melonArtist);

    //     $this->assertNull($artistResource->featured_image_path);
    //     $this->assertNull($artistResource->profile_image_path);
    // }

    public function test_has_image_artist_resource(): void
    {
        $melonArtist = MelonArtist::make(3055146);   // IVE

        $artistResource = ArtistNullResource::make($melonArtist);

        $this->assertStringStartsWith('https://cdnimg.melon.co.kr/cm2/artistcrop/images/', $artistResource->featured_image_path);
    }
}
