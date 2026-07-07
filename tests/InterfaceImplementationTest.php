<?php

namespace Cable8mm\WaterMelon\Tests;

use Cable8mm\WaterMelon\Contracts\AlbumInterface;
use Cable8mm\WaterMelon\Contracts\AlbumResourceInterface;
use Cable8mm\WaterMelon\Contracts\ArtistInterface;
use Cable8mm\WaterMelon\Contracts\ArtistResourceInterface;
use Cable8mm\WaterMelon\Contracts\SongInterface;
use Cable8mm\WaterMelon\Contracts\SongResourceInterface;
use Cable8mm\WaterMelon\MelonAlbum;
use Cable8mm\WaterMelon\MelonArtist;
use Cable8mm\WaterMelon\MelonSong;
use Cable8mm\WaterMelon\Resources\AlbumResource;
use Cable8mm\WaterMelon\Resources\ArtistResource;
use Cable8mm\WaterMelon\Resources\SongResource;
use PHPUnit\Framework\TestCase;

/**
 * @group online
 */
final class InterfaceImplementationTest extends TestCase
{
    public function test_melon_song_implements_song_interface(): void
    {
        $song = MelonSong::make(35945927);

        $this->assertInstanceOf(SongInterface::class, $song);
        $this->assertInstanceOf(\ArrayAccess::class, $song);
    }

    public function test_melon_album_implements_album_interface(): void
    {
        $album = MelonAlbum::make(11127145);

        $this->assertInstanceOf(AlbumInterface::class, $album);
        $this->assertInstanceOf(\ArrayAccess::class, $album);
    }

    public function test_melon_artist_implements_artist_interface(): void
    {
        $artist = MelonArtist::make(3114174);

        $this->assertInstanceOf(ArtistInterface::class, $artist);
        $this->assertInstanceOf(\ArrayAccess::class, $artist);
    }

    public function test_song_resource_implements_interface(): void
    {
        $song = MelonSong::make(35945927);
        $resource = SongResource::make($song);

        $this->assertInstanceOf(SongResourceInterface::class, $resource);
    }

    public function test_album_resource_implements_interface(): void
    {
        $album = MelonAlbum::make(11127145);
        $resource = AlbumResource::make($album);

        $this->assertInstanceOf(AlbumResourceInterface::class, $resource);
    }

    public function test_artist_resource_implements_interface(): void
    {
        $artist = MelonArtist::make(3114174);
        $resource = ArtistResource::make($artist);

        $this->assertInstanceOf(ArtistResourceInterface::class, $resource);
    }

    public function test_song_interface_has_required_methods(): void
    {
        $song = MelonSong::make(35945927);

        // Test that all interface methods are callable
        $this->assertIsCallable([$song, 'parse']);
        $this->assertIsCallable([$song, 'getId']);
        $this->assertIsCallable([$song, 'getTitle']);
        $this->assertIsCallable([$song, 'getAlbumId']);
        $this->assertIsCallable([$song, 'getArtworkImagePath']);
    }

    public function test_album_interface_has_required_methods(): void
    {
        $album = MelonAlbum::make(11127145);

        $this->assertIsCallable([$album, 'parse']);
        $this->assertIsCallable([$album, 'getId']);
        $this->assertIsCallable([$album, 'getTitle']);
        $this->assertIsCallable([$album, 'getAlbumCoverPath']);
        $this->assertIsCallable([$album, 'getReleasedAt']);
    }

    public function test_artist_interface_has_required_methods(): void
    {
        $artist = MelonArtist::make(3114174);

        $this->assertIsCallable([$artist, 'parse']);
        $this->assertIsCallable([$artist, 'getId']);
        $this->assertIsCallable([$artist, 'getName']);
        $this->assertIsCallable([$artist, 'getFeaturedImagePath']);
        $this->assertIsCallable([$artist, 'getProfileImagePath']);
        $this->assertIsCallable([$artist, 'getBirth']);
        $this->assertIsCallable([$artist, 'getDebut']);
        $this->assertIsCallable([$artist, 'getAgency']);
        $this->assertIsCallable([$artist, 'getGenre']);
    }

    public function test_song_resource_interface_has_required_methods(): void
    {
        $song = MelonSong::make(35945927);
        $resource = SongResource::make($song);

        $this->assertIsCallable([$resource, 'toArray']);
        $this->assertIsCallable([$resource, 'getMelonSongId']);
        $this->assertIsCallable([$resource, 'getTitle']);
        $this->assertIsCallable([$resource, 'getAlbumId']);
        $this->assertIsCallable([$resource, 'getArtworkImagePath']);
    }

    public function test_album_resource_interface_has_required_methods(): void
    {
        $album = MelonAlbum::make(11127145);
        $resource = AlbumResource::make($album);

        $this->assertIsCallable([$resource, 'toArray']);
        $this->assertIsCallable([$resource, 'getMelonAlbumId']);
        $this->assertIsCallable([$resource, 'getTitle']);
        $this->assertIsCallable([$resource, 'getAlbumCoverPath']);
        $this->assertIsCallable([$resource, 'getReleasedAt']);
    }

    public function test_artist_resource_interface_has_required_methods(): void
    {
        $artist = MelonArtist::make(3114174);
        $resource = ArtistResource::make($artist);

        $this->assertIsCallable([$resource, 'toArray']);
        $this->assertIsCallable([$resource, 'getMelonArtistId']);
        $this->assertIsCallable([$resource, 'getName']);
        $this->assertIsCallable([$resource, 'getFeaturedImagePath']);
        $this->assertIsCallable([$resource, 'getProfileImagePath']);
        $this->assertIsCallable([$resource, 'getDebut']);
    }
}
