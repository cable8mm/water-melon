<?php

namespace Cable8mm\WaterMelon;

class MelonSong extends Melon
{
    public function parse()
    {
        if ($this->response) {
            return $this->response;
        }

        $url = "https://m2.melon.com/m6/v3/song/info.json?songId={$this->id}";

        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', $url);

        $json = json_decode($response->getBody()->getContents(), true);

        return $this->response = $json['response'];
    }
}
