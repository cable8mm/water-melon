<?php

namespace Cable8mm\WaterMelon\Tests;

use Cable8mm\WaterMelon\Resources\AlbumResource;
use Cable8mm\WaterMelon\Resources\ArtistResource;
use Cable8mm\WaterMelon\Resources\SongResource;
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
        $this->assertEquals('https://cdnimg.melon.co.kr/cm2/artistcrop/images/007/56/530/756530_20230321133428_org.jpg?aeabfd6f9270dbe26edee82c1c24bf0b/melon/resize/1000/optimize/90', $artistResource->featured_image_path);
        $this->assertEquals('https://cdnimg.melon.co.kr/cm2/artistcrop/images/007/56/530/756530_20230321133428_500.jpg?aeabfd6f9270dbe26edee82c1c24bf0b/melon/optimize/90', $artistResource->profile_image_path);
        $this->assertEquals(null, $artistResource->debut);
    }
}
