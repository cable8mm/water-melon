<?php

namespace Cable8mm\WaterMelon\Tests;

use Cable8mm\WaterMelon\Resources\AlbumResource;
use Cable8mm\WaterMelon\WaterMelon;
use PHPUnit\Framework\TestCase;

final class AlbumResourceTest extends TestCase
{
    public function test_album_resource(): void
    {
        $waterMelon = WaterMelon::make(36264543);   // 솔라 (마마무) Eternal's song id

        $albumResource = AlbumResource::make($waterMelon->song);

        $this->assertEquals(11200325, $albumResource->melon_albumid);
        $this->assertEquals('판도라 : 조작된 낙원 OST Part 1', $albumResource->title);
        $this->assertStringStartsWith('https://cdnimg.melon.co.kr/cm2/album/images/', $albumResource->album_cover_path);
        $this->assertEquals('2023.03.12', $albumResource->released_at);
    }
}
