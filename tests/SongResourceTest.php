<?php

namespace Cable8mm\WaterMelon\Tests;

use Cable8mm\WaterMelon\Resources\SongResource;
use Cable8mm\WaterMelon\WaterMelon;
use PHPUnit\Framework\TestCase;

final class SongResourceTest extends TestCase
{
    public function test_song_resource()
    {
        $waterMelon = WaterMelon::make(36264543);   // 솔라 (마마무) Eternal's song id

        $songResource = SongResource::make($waterMelon->song);

        $this->assertEquals(36264543, $songResource->melon_songid);
        $this->assertEquals(11200325, $songResource->album_id);
        $this->assertEquals('Eternal', $songResource->title);
        $this->assertStringStartsWith('https://cdnimg.melon.co.kr/cm2/album/images/', $songResource->artwork_image_path);
    }
}
