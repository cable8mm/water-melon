<?php

namespace Cable8mm\WaterMelon;

/**
 * Fetches information about a artist from the melon.com API.
 *
 * @since  2023-03-20
 */
class MelonArtist extends Melon
{
    /**
     * {@inheritDoc}
     */
    public function parse(): array
    {
        if ($this->response) {
            return $this->response;
        }

        $url = "https://m2.melon.com/m6/v3/artist/home/basicInfo.json?artistId={$this->id}";

        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', $url);

        $json = json_decode($response->getBody()->getContents(), true);

        return $this->response = $json['response'];
    }
}
