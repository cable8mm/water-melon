<?php

namespace Cable8mm\WaterMelon\Tests;

use Cable8mm\WaterMelon\Exceptions\MelonApiException;
use Cable8mm\WaterMelon\MelonSong;
use Cable8mm\WaterMelon\WaterMelon;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * @group online
 */
final class EdgeCaseTest extends TestCase
{
    public function test_empty_response_throws_exception(): void
    {
        $mock = new Client([
            'handler' => new MockHandler([
                new Response(200, [], ''),
            ]),
        ]);

        $this->expectException(MelonApiException::class);
        $this->expectExceptionMessage('Empty response received from');

        $song = MelonSong::make(35945927, $mock);
        $song->parse();
    }

    public function test_invalid_json_throws_exception(): void
    {
        $mock = new Client([
            'handler' => new MockHandler([
                new Response(200, [], 'invalid json{{{'),
            ]),
        ]);

        $this->expectException(MelonApiException::class);
        $this->expectExceptionMessageMatches('/Failed to parse JSON/');

        $song = MelonSong::make(35945927, $mock);
        $song->parse();
    }

    public function test_missing_response_key_throws_exception(): void
    {
        $mock = new Client([
            'handler' => new MockHandler([
                new Response(200, [], json_encode(['data' => 'test'])),
            ]),
        ]);

        $this->expectException(MelonApiException::class);
        $this->expectExceptionMessage("Invalid API response structure: missing 'response' key");

        $song = MelonSong::make(35945927, $mock);
        $song->parse();
    }

    public function test_watermelon_with_invalid_song_id(): void
    {
        $this->expectException(MelonApiException::class);

        WaterMelon::make(999999999);
    }

    public function test_parse_returns_cached_data(): void
    {
        $song = MelonSong::make(35945927);

        // First parse
        $response1 = $song->parse();

        // Second parse should return cached data
        $response2 = $song->parse();

        $this->assertSame($response1, $response2);
    }
}
