<?php

namespace Cable8mm\WaterMelon;

use Cable8mm\WaterMelon\Traits\Makeable;

/**
 * WaterMelon
 *
 * @author  Samgu Lee <cable8mm@gmail.com>
 *
 * @since  2023-03-20
 *
 * @license MIT License
 */
class WaterMelon
{
    use Makeable;

    public const VER = '1.0.0';

    private int $songid;

    public MelonSong $song;

    public MelonAlbum $album;

    public array $artists = [];

    public function __construct(int $songid)
    {
        $this->songid = $songid;

        $this->song = MelonSong::make($this->songid);

        $this->album = MelonAlbum::make($this->song['SONGINFO']['ALBUMID']);

        foreach ($this->song['SONGINFO']['ARTISTLIST'] as $artist) {
            $this->artists[] = MelonArtist::make($artist['ARTISTID']);
        }
    }

    public function parse()
    {
        $this->album->parse();

        foreach ($this->artists as $artist) {
            $artist->parse();
        }

        return $this;
    }

    public function getSong(): MelonSong
    {
        return $this->song;
    }

    public function getAlbum(): MelonAlbum
    {
        return $this->album;
    }

    public function getArtists(): array
    {
        return $this->artists;
    }

    public static function getVer(): string
    {
        return self::VER;
    }
}
