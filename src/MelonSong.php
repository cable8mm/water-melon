<?php

namespace Cable8mm\WaterMelon;

use Cable8mm\WaterMelon\Exceptions\MelonApiException;
use GuzzleHttp\Exception\RequestException;

/**
 * Fetches information about a song from the melon.com API.
 *
 * @since  2023-03-20
 */
class MelonSong extends Melon
{
    /**
     * {@inheritDoc}
     *
     * @throws MelonApiException
     */
    public function parse(): array
    {
        if ($this->response) {
            return $this->response;
        }

        $url = "https://m2.melon.com/m6/v3/song/info.json?songId={$this->id}";

        try {
            $requestOptions = [
                'headers' => [
                    'Cookie' => 'PCID='.rand().';',
                ],
            ];

            $response = $this->client->request('GET', $url, $requestOptions);
            $body = $response->getBody()->getContents();

            if (empty($body)) {
                throw MelonApiException::emptyResponse($url);
            }

            $json = json_decode($body, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw MelonApiException::jsonParseError($url, json_last_error_msg());
            }

            if (! isset($json['response'])) {
                throw MelonApiException::invalidResponse('response');
            }

            return $this->response = $json['response'];
        } catch (RequestException $e) {
            throw MelonApiException::requestFailed($url, $e->getMessage());
        }
    }
}
