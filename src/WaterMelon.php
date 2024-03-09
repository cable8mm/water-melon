<?php

namespace Cable8mm\WaterMelon;

use Cable8mm\WaterMelon\Traits\Makeable;

/**
 * Fetch all information about a song, song's albums and song's artists from the melon.com API.
 *
 * @author  Samgu Lee <cable8mm@gmail.com>
 *
 * @since  2023-03-20
 */
class WaterMelon
{
    use Makeable;

    private int $songid;

    public MelonSong $song;

    public MelonAlbum $album;

    /**
     * @var Melon[]
     */
    public array $artists = [];

    /**
     * Constructor.
     *
     * @param  int  $songid  Melon song ID.
     */
    public function __construct(int $songid)
    {
        $this->songid = $songid;

        $this->song = MelonSong::make($this->songid);

        $this->album = MelonAlbum::make($this->song['SONGINFO']['ALBUMID']);

        foreach ($this->song['SONGINFO']['ARTISTLIST'] as $artist) {
            $this->artists[] = MelonArtist::make($artist['ARTISTID']);
        }
    }

    /**
     * To get a instance of the WaterMelon class after fetching information about a song from the melon.com API.
     */
    public function parse(): static
    {
        $this->album->parse();

        /**
         * @var $artist MelonArtist
         */
        foreach ($this->artists as $artist) {
            $artist->parse();
        }

        return $this;
    }

    /**
     * Getter to get a information about a song.
     */
    public function getSong(): MelonSong
    {
        return $this->song;
    }

    /**
     * Getter to get a information about a album.
     */
    public function getAlbum(): MelonAlbum
    {
        return $this->album;
    }

    /**
     * Getter to get a information about artists.
     *
     * @return MelonArtist[]
     */
    public function getArtists(): array
    {
        return $this->artists;
    }
}
