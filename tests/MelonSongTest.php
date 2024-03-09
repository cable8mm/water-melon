<?php

namespace Cable8mm\WaterMelon\Tests;

use Cable8mm\WaterMelon\MelonSong;
use PHPUnit\Framework\TestCase;

class MelonSongTest extends TestCase
{
    public function test_get_melon_song(): void
    {
        $melonSong = MelonSong::make(35945927);

        $this->assertEquals('Ditto', $melonSong['SONGINFO']['SONGNAME']);
    }
}
