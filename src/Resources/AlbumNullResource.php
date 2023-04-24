<?php

namespace Cable8mm\WaterMelon\Resources;

class AlbumResource extends Resource
{
    public function toArray()
    {
        return [
            'melon_albumid' => $this->melon['ALBUMINFO']['ALBUMID'],
            'title' => $this->melon['ALBUMINFO']['ALBUMNAME'],
            'album_cover_path' => self::emptyToNull($this->melon['ALBUMINFO']['ALBUMIMG']),
            'released_at' => $this->melon['ALBUMINFO']['ISSUEDATE'],
        ];
    }
}
