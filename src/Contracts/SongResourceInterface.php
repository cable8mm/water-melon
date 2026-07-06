<?php

namespace Cable8mm\WaterMelon\Contracts;

/**
 * Interface for song resources.
 *
 * @since  2024-01-15
 */
interface SongResourceInterface
{
    /**
     * Get the resource as an array.
     */
    public function toArray(): array;

    /**
     * Get the song ID.
     */
    public function getMelonSongId(): int;

    /**
     * Get the song title.
     */
    public function getTitle(): string;

    /**
     * Get the album ID.
     */
    public function getAlbumId(): int;

    /**
     * Get the artwork image path.
     */
    public function getArtworkImagePath(): ?string;
}
