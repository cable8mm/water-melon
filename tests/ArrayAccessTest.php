<?php

namespace Cable8mm\WaterMelon\Tests;

use Cable8mm\WaterMelon\MelonAlbum;
use Cable8mm\WaterMelon\MelonArtist;
use Cable8mm\WaterMelon\MelonSong;
use PHPUnit\Framework\TestCase;

/**
 * @group online
 */
final class ArrayAccessTest extends TestCase
{
    public function test_song_array_access_get(): void
    {
        $song = MelonSong::make(35945927);

        $this->assertArrayHasKey('SONGINFO', $song);
        $this->assertArrayHasKey('SONGNAME', $song['SONGINFO']);
        $this->assertSame('Ditto', $song['SONGINFO']['SONGNAME']);
    }

    public function test_song_array_access_offset_exists(): void
    {
        $song = MelonSong::make(35945927);

        $this->assertTrue(isset($song['SONGINFO']));
        $this->assertFalse(isset($song['NONEXISTENT']));
    }

    public function test_album_array_access_get(): void
    {
        $album = MelonAlbum::make(11127145);

        $this->assertArrayHasKey('ALBUMINFO', $album);
        $this->assertArrayHasKey('ALBUMNAME', $album['ALBUMINFO']);
    }

    public function test_artist_array_access_get(): void
    {
        $artist = MelonArtist::make(3114174);

        $this->assertArrayHasKey('ARTISTNAME', $artist);
        $this->assertSame('NewJeans', $artist['ARTISTNAME']);
    }

    public function test_array_access_returns_null_for_missing_key(): void
    {
        $song = MelonSong::make(35945927);

        $this->assertNull($song['NONEXISTENT_KEY']);
        $this->assertNull($song['SONGINFO']['NONEXISTENT']);
    }
}
