<?php

namespace Cable8mm\WaterMelon\Resources;

class SongResource extends Resource
{
    public function toArray()
    {
        return [
            'album_id' => $this->melon['SONGINFO']['ALBUMID'],
            'melon_songid' => $this->melon['SONGINFO']['SONGID'],
            'title' => $this->melon['SONGINFO']['SONGNAME'],
            'artwork_image_path' => $this->melon['SONGINFO']['ALBUMIMG'],
        ];
    }
}
