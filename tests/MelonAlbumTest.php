<?php

namespace Cable8mm\WaterMelon\Tests;

use Cable8mm\WaterMelon\MelonAlbum;
use PHPUnit\Framework\TestCase;

class MelonAlbumTest extends TestCase
{
    public function test_get_melon_album(): void
    {
        $melonAlbum = MelonAlbum::make(11127145);

        $this->assertEquals('NewJeans \'OMG\'', $melonAlbum['ALBUMINFO']['ALBUMNAME']);
    }
}
