<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class MelonAlbumTest extends TestCase
{
    public function test_get_melon_album()
    {
        $melonAlbum = new Cable8mm\WaterMelon\MelonAlbum(3114174);

        $this->assertEquals($melonAlbum->parse()['ALBUMINFO']['ALBUMNAME'], 'Sound Clash');
    }
}
