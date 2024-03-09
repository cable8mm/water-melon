<?php

namespace Cable8mm\WaterMelon\Resources;

use Cable8mm\WaterMelon\MelonAlbum;

/**
 * Album resource with null for mapping from melon.com.
 *
 * @since  2023-03-20
 */
class AlbumNullResource extends Resource
{
    /**
     * {@inheritDoc}
     *
     * Additionally, AlbumNullResource attributes are returned.
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

    /**
     * Create a new AlbumNullResource instance.
     */
    public static function make(MelonAlbum $melonAlbum): static
    {
        return new static($melonAlbum);
    }
}
