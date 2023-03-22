<?php

namespace Cable8mm\WaterMelon;

class MelonAlbum extends Melon
{
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
