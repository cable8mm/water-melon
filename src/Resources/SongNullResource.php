<?php

namespace Cable8mm\WaterMelon\Resources;

/**
 * Song resource with null for mapping from melon.com.
 */
class SongNullResource extends Resource
{
    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'album_id' => $this->melon['SONGINFO']['ALBUMID'],
            'melon_songid' => $this->melon['SONGINFO']['SONGID'],
            'title' => $this->melon['SONGINFO']['SONGNAME'],
            'artwork_image_path' => self::emptyToNull($this->melon['SONGINFO']['ALBUMIMG']),
        ];
    }
}
