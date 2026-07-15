<?php

namespace Cable8mm\WaterMelon\Resources;

use Cable8mm\WaterMelon\Contracts\AlbumResourceInterface;
use Cable8mm\WaterMelon\MelonAlbum;

/**
 * Album resource for mapping from melon.com.
 *
 * @since  2023-03-20
 *
 * @property MelonAlbum $melon
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
            'melon_albumid' => $this->melon->getId(),
            'title' => $this->melon->getTitle(),
            'album_cover_path' => $this->melon->getAlbumCoverPath(),
            'released_at' => $this->melon->getReleasedAt(),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getMelonAlbumId(): int
    {
        return $this->melon->getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getTitle(): string
    {
        return $this->melon->getTitle();
    }

    /**
     * {@inheritDoc}
     */
    public function getAlbumCoverPath(): ?string
    {
        return $this->melon->getAlbumCoverPath();
    }

    /**
     * {@inheritDoc}
     */
    public function getReleasedAt(): ?string
    {
        return $this->melon->getReleasedAt();
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
