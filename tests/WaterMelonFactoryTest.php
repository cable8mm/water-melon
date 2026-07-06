<?php

namespace Cable8mm\WaterMelon\Tests;

use Cable8mm\WaterMelon\Contracts\AlbumInterface;
use Cable8mm\WaterMelon\Contracts\ArtistInterface;
use Cable8mm\WaterMelon\Contracts\SongInterface;
use Cable8mm\WaterMelon\WaterMelonFactory;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

final class WaterMelonFactoryTest extends TestCase
{
    public function test_create_watermelon_from_song_id(): void
    {
        $waterMelon = WaterMelonFactory::make(35945927);

        $this->assertInstanceOf(SongInterface::class, $waterMelon->song);
        $this->assertInstanceOf(AlbumInterface::class, $waterMelon->album);
        $this->assertIsArray($waterMelon->artists);
        $this->assertInstanceOf(ArtistInterface::class, $waterMelon->artists[0]);
    }

    public function test_factory_returns_watermelon_instance(): void
    {
        $waterMelon = WaterMelonFactory::make(35945927);

        $this->assertSame(35945927, $waterMelon->getSong()->getId());
        $this->assertSame(11127145, $waterMelon->getAlbum()->getId());
        $this->assertSame(3114174, $waterMelon->getArtists()[0]->getId());
    }

    public function test_factory_with_custom_client(): void
    {
        $client = new Client([
            'timeout' => 5,
        ]);

        $waterMelon = WaterMelonFactory::make(35945927, $client);

        $this->assertInstanceOf(SongInterface::class, $waterMelon->song);
        $this->assertSame('Ditto', $waterMelon->getSong()->getTitle());
    }
}
