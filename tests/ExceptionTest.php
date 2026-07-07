<?php

namespace Cable8mm\WaterMelon\Tests;

use Cable8mm\WaterMelon\Exceptions\MelonApiException;
use Cable8mm\WaterMelon\MelonSong;
use PHPUnit\Framework\TestCase;

/**
 * @group online
 */
final class ExceptionTest extends TestCase
{
    public function test_song_exception_has_correct_message(): void
    {
        $this->expectException(MelonApiException::class);
        $this->expectExceptionMessage("Invalid API response structure: missing 'response' key");

        $song = new MelonSong(999999999); // Invalid song ID
        $song->parse();
    }

    public function test_exception_factory_methods(): void
    {
        $exception1 = MelonApiException::invalidResponse('test_key');
        $this->assertSame("Invalid API response structure: missing 'test_key' key", $exception1->getMessage());

        $exception2 = MelonApiException::requestFailed('http://test.com', 'Connection timeout');
        $this->assertSame('Failed to fetch data from http://test.com: Connection timeout', $exception2->getMessage());

        $exception3 = MelonApiException::jsonParseError('http://test.com', 'Syntax error');
        $this->assertSame('Failed to parse JSON response from http://test.com: Syntax error', $exception3->getMessage());

        $exception4 = MelonApiException::emptyResponse('http://test.com');
        $this->assertSame('Empty response received from http://test.com', $exception4->getMessage());
    }

    public function test_exception_is_instance_of_exception(): void
    {
        $exception = MelonApiException::invalidResponse('test');

        $this->assertInstanceOf(\Exception::class, $exception);
        $this->assertInstanceOf(\Throwable::class, $exception);
    }
}
