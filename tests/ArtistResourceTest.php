<?php

namespace Cable8mm\WaterMelon\Tests;

use Cable8mm\WaterMelon\Resources\ArtistResource;
use Cable8mm\WaterMelon\WaterMelon;
use PHPUnit\Framework\TestCase;

final class ArtistResourceTest extends TestCase
{
    public function test_artist_resource()
    {
        $waterMelon = WaterMelon::make(36264543);   // 솔라 (마마무) Eternal's song id

        $artistResource = ArtistResource::make($waterMelon->artists[0]);

        $this->assertEquals(756530, $artistResource->melon_artistid);
        $this->assertEquals('솔라 (마마무)', $artistResource->name);
        $this->assertEquals(null, $artistResource->debut);
    }
}
