<?php

namespace Cable8mm\WaterMelon\Contracts;

use ArrayAccess;

/**
 * Interface for song resources.
 *
 * @since  2024-01-15
 */
interface SongInterface extends ArrayAccess
{
    /**
     * Parse the resource data.
     */
    public function parse(): array;

    /**
     * Get the song ID.
     */
    public function getId(): int;

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
