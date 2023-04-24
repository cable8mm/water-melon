<?php

namespace Cable8mm\WaterMelon\Tests;

use Cable8mm\WaterMelon\MelonArtist;
use Cable8mm\WaterMelon\Resources\ArtistNullResource;
use PHPUnit\Framework\TestCase;

final class ArtistNullResourceTest extends TestCase
{
    public function test_havnt_image_artist_resource()
    {
        $melonArtist = MelonArtist::make(3102913);   // HEYA

        $artistResource = ArtistNullResource::make($melonArtist);

        $this->assertNull($artistResource->featured_image_path);
        $this->assertNull($artistResource->profile_image_path);
    }

    public function test_has_image_artist_resource()
    {
        $melonArtist = MelonArtist::make(3055146);   // IVE

        $artistResource = ArtistNullResource::make($melonArtist);

        $this->assertEquals('https://cdnimg.melon.co.kr/cm2/artistcrop/images/030/55/146/3055146_20230410142647_org.jpg?0453ee96ef852e4d5ce0e98daacc4d6a/melon/resize/1000/optimize/90', $artistResource->featured_image_path);
    }
}
