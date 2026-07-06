<?php

namespace Cable8mm\WaterMelon;

use GuzzleHttp\Client;

/**
 * Factory class for creating WaterMelon instances.
 *
 * @since  2024-01-15
 */
class WaterMelonFactory
{
    /**
     * Create a new WaterMelon instance from a song ID.
     *
     * @param  int  $songId  Melon song ID
     * @param  Client|null  $client  HTTP client instance
     */
    public static function make(int $songId, ?Client $client = null): WaterMelon
    {
        $song = MelonSong::make($songId, $client);

        $album = MelonAlbum::make($song->getAlbumId(), $client);

        $artists = [];
        foreach ($song->parse()['SONGINFO']['ARTISTLIST'] as $artistData) {
            $artists[] = MelonArtist::make($artistData['ARTISTID'], $client);
        }

        return new WaterMelon($song, $album, $artists);
    }
}
