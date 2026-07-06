<?php

namespace Cable8mm\WaterMelon\Tests;

use Cable8mm\WaterMelon\Exceptions\MelonApiException;
use Cable8mm\WaterMelon\MelonSong;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class NetworkErrorTest extends TestCase
{
    public function test_song_handles_connection_timeout(): void
    {
        $this->markTestIncomplete('ConnectException handling requires additional configuration');
    }

    public function test_album_handles_connection_timeout(): void
    {
        $this->markTestIncomplete('ConnectException handling requires additional configuration');
    }

    public function test_artist_handles_connection_timeout(): void
    {
        $this->markTestIncomplete('ConnectException handling requires additional configuration');
    }

    public function test_song_handles_http_error_500(): void
    {
        $mock = new MockHandler([
            new Response(500, [], 'Internal Server Error'),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $this->expectException(MelonApiException::class);

        $song = MelonSong::make(35945927, $client);
        $song->parse();
    }

    public function test_song_handles_http_error_404(): void
    {
        $mock = new MockHandler([
            new Response(404, [], 'Not Found'),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $this->expectException(MelonApiException::class);

        $song = MelonSong::make(35945927, $client);
        $song->parse();
    }
}
