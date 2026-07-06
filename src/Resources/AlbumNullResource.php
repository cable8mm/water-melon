<?php

namespace Cable8mm\WaterMelon\Resources;

use Cable8mm\WaterMelon\Contracts\AlbumResourceInterface;
use Cable8mm\WaterMelon\MelonAlbum;

/**
 * Album resource with null for mapping from melon.com.
 *
 * @since  2023-03-20
 */
class AlbumNullResource extends Resource implements AlbumResourceInterface
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
     * {@inheritDoc}
     */
    public function getMelonAlbumId(): int
    {
        return $this->melon['ALBUMINFO']['ALBUMID'];
    }

    /**
     * {@inheritDoc}
     */
    public function getTitle(): string
    {
        return $this->melon['ALBUMINFO']['ALBUMNAME'];
    }

    /**
     * {@inheritDoc}
     */
    public function getAlbumCoverPath(): ?string
    {
        return self::emptyToNull($this->melon['ALBUMINFO']['ALBUMIMG']);
    }

    /**
     * {@inheritDoc}
     */
    public function getReleasedAt(): ?string
    {
        return $this->melon['ALBUMINFO']['ISSUEDATE'];
    }

    /**
     * Create a new AlbumNullResource instance.
     */
    public static function make(MelonAlbum $melonAlbum): static
    {
        return new static($melonAlbum);
    }
}
