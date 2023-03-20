<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class MelonSongTest extends TestCase
{
    public function test_get_project_version()
    {
        $this->assertEquals(Cable8mm\WaterMelon\WaterMelon::VER, '1.0.0');
    }

    public function test_get_melon_song()
    {
        $melonSong = new Cable8mm\WaterMelon\MelonSong(35945927);

        $this->assertEquals($melonSong->parse()['SONGINFO']['SONGNAME'], 'Ditto');
    }
}
