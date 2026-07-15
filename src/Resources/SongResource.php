<?php

namespace Cable8mm\WaterMelon\Resources;

use Cable8mm\WaterMelon\Contracts\SongResourceInterface;
use Cable8mm\WaterMelon\MelonSong;

/**
 * Song resource for mapping from melon.com.
 *
 * @since  2023-03-20
 *
 * @property MelonSong $melon
 */
class SongResource extends Resource implements SongResourceInterface
{
    /**
     * {@inheritDoc}
     *
     * Additionally, SongResource attributes are returned.
     */
    public function toArray(): array
    {
        return [
            'album_id' => $this->melon->getAlbumId(),
            'melon_songid' => $this->melon->getId(),
            'title' => $this->melon->getTitle(),
            'artwork_image_path' => $this->melon->getArtworkImagePath(),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getMelonSongId(): int
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
    public function getAlbumId(): int
    {
        return $this->melon->getAlbumId();
    }

    /**
     * {@inheritDoc}
     */
    public function getArtworkImagePath(): ?string
    {
        return $this->melon->getArtworkImagePath();
    }

    /**
     * Create a new SongResource instance.
     *
     * @example $song = SongResource::make(WaterMelon::make(35945927)->getSong());
     * print $artist->melon_artistid;
     * // 3114174
     * print $artist->name;
     * //=> NewJeans
     * print $artist->featured_image_path;
     * //=> https://cdnimg.melon.co.kr/cm2/artistcrop/images/031/14/174/3114174_20231219153524_500.jpg?8d4887c3dea0a5262fe256c1aef2a9d2/melon/resize/100/optimize/90
     */
    public static function make(MelonSong $melonSong): static
    {
        return new static($melonSong);
    }
}
