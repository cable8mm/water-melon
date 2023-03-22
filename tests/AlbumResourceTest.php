<?php

namespace Cable8mm\WaterMelon\Tests;

use Cable8mm\WaterMelon\Resources\AlbumResource;
use Cable8mm\WaterMelon\WaterMelon;
use PHPUnit\Framework\TestCase;

final class AlbumResourceTest extends TestCase
{
    public function test_album_resource()
    {
        $waterMelon = WaterMelon::make(36264543);   // 솔라 (마마무) Eternal's song id

        $albumResource = AlbumResource::make($waterMelon->song);

        $this->assertEquals(11200325, $albumResource->melon_albumid);
        $this->assertEquals('판도라 : 조작된 낙원 OST Part 1', $albumResource->title);
        $this->assertEquals('https://cdnimg.melon.co.kr/cm2/album/images/112/00/325/11200325_20230309180116_500.jpg?cd9b1b372afa91adf4439d2f5579bf41/melon/resize/255/optimize/90', $albumResource->album_cover_path);
        $this->assertEquals('2023.03.12', $albumResource->released_at);
    }
}
