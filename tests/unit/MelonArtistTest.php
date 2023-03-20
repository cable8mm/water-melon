<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class MelonArtistTest extends TestCase
{
    public function test_get_melon_artist()
    {
        $melonArtist = new Cable8mm\WaterMelon\MelonArtist(3114174);

        $this->assertEquals($melonArtist->parse()['ARTISTNAME'], 'NewJeans');
    }
}
