<?php

namespace Cable8mm\WaterMelon\Resources;

/**
 * Song resource for mapping from melon.com.
 */
class SongResource extends Resource
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
            'artwork_image_path' => $this->melon['SONGINFO']['ALBUMIMG'],
        ];
    }
}
