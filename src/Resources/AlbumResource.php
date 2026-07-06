<?php

namespace Cable8mm\WaterMelon\Resources;

use Cable8mm\WaterMelon\Contracts\AlbumResourceInterface;
use Cable8mm\WaterMelon\MelonAlbum;

/**
 * Album resource for mapping from melon.com.
 *
 * @since  2023-03-20
 *
 * @example AlbumResource::make($waterMelon->getAlbum());
 */
class AlbumResource extends Resource implements AlbumResourceInterface
{
    /**
     * {@inheritDoc}
     *
     * Additionally, AlbumResource attributes are returned.
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
     * Create a new AlbumResource instance.
     *
     * @example $album = AlbumResource::make($waterMelon->getAlbum());
     * // print $album->melon_albumid;
     * //=> 1127145
     * // print $album->title;
     * //=> NewJeans 'OMG'
     * // print $album->album_cover_path;
     * //=> https://cdnimg.melon.co.kr/cm2/album/images/111/27/145/11127145_20231213133532_500.jpg?42f8389c13de0f5f8e4c722bbb0d4bd7/melon/resize/255/optimize/90
     * // print $album->released_at;
     * //=> 2023.01.02
     */
    public static function make(MelonAlbum $melonAlbum): static
    {
        return new static($melonAlbum);
    }
}
