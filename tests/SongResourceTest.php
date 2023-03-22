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
        $this->assertEquals('https://cdnimg.melon.co.kr/cm2/album/images/112/00/325/11200325_20230309180116_500.jpg?cd9b1b372afa91adf4439d2f5579bf41/melon/resize/144/optimize/90', $songResource->artwork_image_path);
    }
}
