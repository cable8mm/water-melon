<?php

namespace Cable8mm\WaterMelon;

use Cable8mm\WaterMelon\Traits\Makeable;

class MelonAlbum
{
    use Makeable;

    public int $id;

    private array $response = [];

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function parse()
    {
        if ($this->response) {
            return $this->response;
        }

        $url = "https://m2.melon.com/m6/v2/album/info.json?albumId={$this->id}";

        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', $url);

        $json = json_decode($response->getBody()->getContents(), true);

        return $this->response = $json['response'];
    }
}
