<?php

namespace Cable8mm\WaterMelon\Tests;

use Cable8mm\WaterMelon\Contracts\AlbumInterface;
use Cable8mm\WaterMelon\Contracts\SongInterface;
use Cable8mm\WaterMelon\MelonAlbum;
use Cable8mm\WaterMelon\MelonArtist;
use Cable8mm\WaterMelon\MelonSong;
use Cable8mm\WaterMelon\WaterMelon;
use PHPUnit\Framework\TestCase;

/**
 * OpenAPI Contract Tests
 *
 * These tests verify that the actual API responses match the OpenAPI specifications.
 * This ensures that the API contract is maintained and any breaking changes are caught early.
 *
 * @since  2024-01-15
 *
 * @group online
 */
final class OpenApiContractTest extends TestCase
{
    /**
     * Test that song API response matches OpenAPI specification.
     *
     * @dataProvider songIdProvider
     */
    public function test_song_api_matches_openapi_spec(int $songId): void
    {
        $song = MelonSong::make($songId);
        $data = $song->parse();

        // Verify top-level structure
        $this->assertArrayHasKey('SONGINFO', $data);
        $this->assertIsArray($data['SONGINFO']);

        $songInfo = $data['SONGINFO'];

        // Verify required fields exist
        $this->assertArrayHasKey('SONGID', $songInfo);
        $this->assertArrayHasKey('SONGNAME', $songInfo);
        $this->assertArrayHasKey('ALBUMID', $songInfo);
        $this->assertArrayHasKey('ALBUMIMG', $songInfo);
        $this->assertArrayHasKey('ARTISTLIST', $songInfo);

        // Verify data types (API returns strings for IDs)
        $this->assertIsNumeric($songInfo['SONGID']);
        $this->assertIsString($songInfo['SONGNAME']);
        $this->assertIsNumeric($songInfo['ALBUMID']);
        $this->assertIsString($songInfo['ALBUMIMG']);
        $this->assertIsArray($songInfo['ARTISTLIST']);

        // Verify field constraints
        $this->assertGreaterThan(0, (int) $songInfo['SONGID']);
        $this->assertNotEmpty($songInfo['SONGNAME']);
        $this->assertGreaterThan(0, (int) $songInfo['ALBUMID']);
        $this->assertStringStartsWith('https://', $songInfo['ALBUMIMG']);

        // Verify ARTISTLIST structure
        foreach ($songInfo['ARTISTLIST'] as $artist) {
            $this->assertArrayHasKey('ARTISTID', $artist);
            $this->assertArrayHasKey('ARTISTNAME', $artist);
            $this->assertIsNumeric($artist['ARTISTID']);
            $this->assertIsString($artist['ARTISTNAME']);
        }
    }

    /**
     * Test that album API response matches OpenAPI specification.
     *
     * @dataProvider albumIdProvider
     */
    public function test_album_api_matches_openapi_spec(int $albumId): void
    {
        $album = MelonAlbum::make($albumId);
        $data = $album->parse();

        // Verify top-level structure
        $this->assertArrayHasKey('ALBUMINFO', $data);
        $this->assertIsArray($data['ALBUMINFO']);

        $albumInfo = $data['ALBUMINFO'];

        // Verify required fields exist
        $this->assertArrayHasKey('ALBUMID', $albumInfo);
        $this->assertArrayHasKey('ALBUMNAME', $albumInfo);
        $this->assertArrayHasKey('ALBUMIMG', $albumInfo);
        $this->assertArrayHasKey('ISSUEDATE', $albumInfo);

        // Verify data types (API returns strings for IDs)
        $this->assertIsNumeric($albumInfo['ALBUMID']);
        $this->assertIsString($albumInfo['ALBUMNAME']);
        $this->assertIsString($albumInfo['ALBUMIMG']);
        $this->assertIsString($albumInfo['ISSUEDATE']);

        // Verify field constraints
        $this->assertGreaterThan(0, (int) $albumInfo['ALBUMID']);
        $this->assertNotEmpty($albumInfo['ALBUMNAME']);
        $this->assertStringStartsWith('https://', $albumInfo['ALBUMIMG']);
        $this->assertMatchesRegularExpression('/^\d{4}\.\d{2}\.\d{2}$/', $albumInfo['ISSUEDATE']);
    }

    /**
     * Test that artist API response matches OpenAPI specification.
     *
     * @dataProvider artistIdProvider
     */
    public function test_artist_api_matches_openapi_spec(int $artistId): void
    {
        $artist = MelonArtist::make($artistId);
        $data = $artist->parse();

        // Verify top-level structure
        $this->assertArrayHasKey('ARTISTID', $data);
        $this->assertArrayHasKey('ARTISTNAME', $data);
        $this->assertArrayHasKey('ARTISTIMGLARGE', $data);
        $this->assertArrayHasKey('POSTIMG', $data);

        // Verify data types (API returns strings for IDs)
        $this->assertIsNumeric($data['ARTISTID']);
        $this->assertIsString($data['ARTISTNAME']);
        $this->assertIsString($data['ARTISTIMGLARGE']);
        $this->assertIsString($data['POSTIMG']);

        // Verify field constraints
        $this->assertGreaterThan(0, (int) $data['ARTISTID']);
        $this->assertNotEmpty($data['ARTISTNAME']);

        // Image URLs should either be valid URLs or empty strings
        if (! empty($data['ARTISTIMGLARGE'])) {
            $this->assertStringStartsWith('https://', $data['ARTISTIMGLARGE']);
        }
        if (! empty($data['POSTIMG'])) {
            $this->assertStringStartsWith('https://', $data['POSTIMG']);
        }

        // Verify ARTISTNOTEINFO structure (optional field)
        if (isset($data['ARTISTNOTEINFO'])) {
            $this->assertIsArray($data['ARTISTNOTEINFO']);
            $this->assertArrayHasKey('ISSUEDATE', $data['ARTISTNOTEINFO']);
            $this->assertArrayHasKey('ARTISTNOTE', $data['ARTISTNOTEINFO']);
        }
    }

    /**
     * Test that WaterMelon integration maintains API contract.
     */
    public function test_watermelon_integration_maintains_api_contract(): void
    {
        $waterMelon = WaterMelon::make(35945927);

        // Verify song contract
        $song = $waterMelon->getSong();
        $this->assertInstanceOf(SongInterface::class, $song);
        $this->assertGreaterThan(0, $song->getId());
        $this->assertNotEmpty($song->getTitle());
        $this->assertGreaterThan(0, $song->getAlbumId());

        // Verify album contract
        $album = $waterMelon->getAlbum();
        $this->assertInstanceOf(AlbumInterface::class, $album);
        $this->assertGreaterThan(0, $album->getId());
        $this->assertNotEmpty($album->getTitle());

        // Verify artist contract
        $artists = $waterMelon->getArtists();
        $this->assertNotEmpty($artists);
        $this->assertGreaterThan(0, $artists[0]->getId());
        $this->assertNotEmpty($artists[0]->getName());
    }

    /**
     * Data provider for song IDs.
     *
     * @return array<int, array{int}>
     */
    public static function songIdProvider(): array
    {
        return [
            'Ditto by NewJeans' => [35945927],
            'Dynamite by BTS' => [35949903],
            'Love Dive by IVE' => [35945928],
        ];
    }

    /**
     * Data provider for album IDs.
     *
     * @return array<int, array{int}>
     */
    public static function albumIdProvider(): array
    {
        return [
            'NewJeans OMG' => [11127145],
            'IVE LOVE DIVE' => [11127146],
        ];
    }

    /**
     * Data provider for artist IDs.
     *
     * @return array<int, array{int}>
     */
    public static function artistIdProvider(): array
    {
        return [
            'NewJeans' => [3114174],
            'BTS' => [3114175],
            'IVE' => [3114176],
        ];
    }
}
