<?php

namespace Cable8mm\WaterMelon;

use Cable8mm\WaterMelon\Contracts\AlbumInterface;
use Cable8mm\WaterMelon\Contracts\ArtistInterface;
use Cable8mm\WaterMelon\Contracts\SongInterface;
use GuzzleHttp\Client;

/**
 * Fetch all information about a song, song's albums and song's artists from the melon.com API.
 *
 * @author  Samgu Lee <cable8mm@gmail.com>
 *
 * @since  2023-03-20
 */
class WaterMelon
{
    /** @var SongInterface Melon song. */
    public SongInterface $song;

    /** @var AlbumInterface Melon album. */
    public AlbumInterface $album;

    /** @var ArtistInterface[] Melon artists. */
    public array $artists = [];

    /**
     * Constructor.
     *
     * @param  SongInterface  $song  Melon song.
     * @param  AlbumInterface  $album  Melon album.
     * @param  ArtistInterface[]  $artists  Melon artists.
     */
    public function __construct(
        SongInterface $song,
        AlbumInterface $album,
        array $artists = []
    ) {
        $this->song = $song;
        $this->album = $album;
        $this->artists = $artists;
    }

    /**
     * Create a new WaterMelon instance from a song ID.
     *
     * @param  int  $songId  Melon song ID
     * @param  Client|null  $client  HTTP client instance
     */
    public static function make(int $songId, ?Client $client = null): static
    {
        $song = MelonSong::make($songId, $client);
        $album = MelonAlbum::make($song->getAlbumId(), $client);
        $artists = [];
        foreach ($song->parse()['SONGINFO']['ARTISTLIST'] as $artistData) {
            $artists[] = MelonArtist::make($artistData['ARTISTID'], $client);
        }

        return new static($song, $album, $artists);
    }

    /**
     * To get a instance of the WaterMelon class after fetching information about a song from the melon.com API.
     */
    public function parse(): static
    {
        $this->album->parse();

        foreach ($this->artists as $artist) {
            $artist->parse();
        }

        return $this;
    }

    /**
     * Getter to get a information about a song.
     *
     * @example WaterMelon::make(35945927)->getSong();
     */
    public function getSong(): SongInterface
    {
        return $this->song;
    }

    /**
     * Getter to get a information about a album.
     *
     * @example WaterMelon::make(35945927)->getAlbum();
     */
    public function getAlbum(): AlbumInterface
    {
        return $this->album;
    }

    /**
     * Getter to get a information about artists.
     *
     * @return ArtistInterface[]
     *
     * @example WaterMelon::make(35945927)->getArtists();
     */
    public function getArtists(): array
    {
        return $this->artists;
    }
}
