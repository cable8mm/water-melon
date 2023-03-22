<?php

namespace Cable8mm\WaterMelon\Tests;

use Cable8mm\WaterMelon\WaterMelon;
use PHPUnit\Framework\TestCase;

final class WaterMelonTest extends TestCase
{
    public function test_get_project_version()
    {
        $this->assertEquals(WaterMelon::VER, '1.0.0');
    }

    public function test_get_song_id()
    {
        $waterMelon = WaterMelon::make(35945927);   // Ditto's song id

        $this->assertEquals(35945927, $waterMelon->song->id);
    }

    public function test_get_album_id()
    {
        $waterMelon = new WaterMelon(35945927); // Ditto's song id

        $this->assertEquals(11127145, $waterMelon->album->id); // 11127145 is Ditto's album id
    }

    public function test_get_melon_artist_id()
    {
        $waterMelon = new WaterMelon(35945927);

        $this->assertEquals(3114174, $waterMelon->artists[0]->id); // 3114174 is Ditto's artist id
    }
}
