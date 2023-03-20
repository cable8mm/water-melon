<?php

namespace Cable8mm\WaterMelon;

use Cable8mm\WaterMelon\Traits\Makeable;

class MelonArtist
{
    use Makeable;

    private int $id;

    private array $response;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function parse()
    {
        $url = "https://m2.melon.com/m6/v3/artist/home/basicInfo.json?artistId={$this->id}";

        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', $url);

        $json = json_decode($response->getBody()->getContents(), true);

        return $this->response = $json['response'];
    }
}
