<?php

namespace Cable8mm\WaterMelon\Resources;

/**
 * Album resource with null for mapping from melon.com.
 */
class AlbumNullResource extends Resource
{
    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'melon_albumid' => $this->melon['ALBUMINFO']['ALBUMID'],
            'title' => $this->melon['ALBUMINFO']['ALBUMNAME'],
            'album_cover_path' => self::emptyToNull($this->melon['ALBUMINFO']['ALBUMIMG']),
            'released_at' => $this->melon['ALBUMINFO']['ISSUEDATE'],
        ];
    }
}
