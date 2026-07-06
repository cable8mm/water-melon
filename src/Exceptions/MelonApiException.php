<?php

namespace Cable8mm\WaterMelon\Exceptions;

use Exception;

/**
 * Exception thrown when the Melon API returns an error or invalid response.
 *
 * @since  2024-01-15
 */
class MelonApiException extends Exception
{
    /**
     * Create a new MelonApiException instance
     *
     * @param  string  $message  The exception message
     * @param  int  $code  The exception code
     * @param  \Throwable|null  $previous  The previous throwable
     */
    public function __construct(string $message = '', int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Create exception for invalid response structure
     */
    public static function invalidResponse(string $expectedKey): self
    {
        return new self("Invalid API response structure: missing '{$expectedKey}' key");
    }

    /**
     * Create exception for HTTP request failure
     */
    public static function requestFailed(string $url, string $reason): self
    {
        return new self("Failed to fetch data from {$url}: {$reason}");
    }

    /**
     * Create exception for JSON parsing failure
     */
    public static function jsonParseError(string $url, string $error): self
    {
        return new self("Failed to parse JSON response from {$url}: {$error}");
    }

    /**
     * Create exception for empty response.
     */
    public static function emptyResponse(string $url): self
    {
        return new self("Empty response received from {$url}");
    }
}
