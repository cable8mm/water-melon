<?php

namespace Cable8mm\WaterMelon\Tests;

use Cable8mm\WaterMelon\MelonArtist;
use PHPUnit\Framework\TestCase;

class MelonArtistTest extends TestCase
{
    public function test_get_melon_artist(): void
    {
        $melonArtist = MelonArtist::make(3114174);

        $this->assertEquals('NewJeans', $melonArtist['ARTISTNAME']);
    }
}
