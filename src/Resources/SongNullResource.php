<?php

namespace Cable8mm\WaterMelon\Resources;

use Cable8mm\WaterMelon\MelonSong;

/**
 * Song resource with null for mapping from melon.com.
 *
 * @since  2023-03-20
 */
class SongNullResource extends Resource
{
    /**
     * {@inheritDoc}
     *
     * Additionally, SongNullResource attributes are returned.
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

    /**
     * Create a new SongNullResource instance.
     */
    public static function make(MelonSong $melonSong): static
    {
        return new static($melonSong);
    }
}
