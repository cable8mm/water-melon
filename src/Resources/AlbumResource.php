<?php

namespace Cable8mm\WaterMelon\Resources;

/**
 * Album resource for mapping from melon.com.
 */
class AlbumResource extends Resource
{
    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'melon_albumid' => $this->melon['ALBUMINFO']['ALBUMID'],
            'title' => $this->melon['ALBUMINFO']['ALBUMNAME'],
            'album_cover_path' => $this->melon['ALBUMINFO']['ALBUMIMG'],
            'released_at' => $this->melon['ALBUMINFO']['ISSUEDATE'],
        ];
    }
}
