<?php

namespace Cable8mm\WaterMelon;

/**
 * Fetches information about a song from the melon.com API.
 *
 * @since  2023-03-20
 */
class MelonSong extends Melon
{
    /**
     * {@inheritDoc}
     */
    public function parse(): array
    {
        if ($this->response) {
            return $this->response;
        }

        $url = "https://m2.melon.com/m6/v3/song/info.json?songId={$this->id}";

        $client = new \GuzzleHttp\Client();

        $requestOptions = [
            'headers' => [
                'Cookie' => 'PCID='.rand().';',
            ],
        ];

        $response = $client->request('GET', $url, $requestOptions);

        $json = json_decode($response->getBody()->getContents(), true);

        return $this->response = $json['response'];
    }
}
