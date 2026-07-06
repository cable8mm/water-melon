<?php

namespace Cable8mm\WaterMelon\Contracts;

use ArrayAccess;

/**
 * Interface for album resources.
 *
 * @since  2024-01-15
 */
interface AlbumInterface extends ArrayAccess
{
    /**
     * Parse the resource data.
     */
    public function parse(): array;

    /**
     * Get the album ID.
     */
    public function getId(): int;

    /**
     * Get the album title.
     */
    public function getTitle(): string;

    /**
     * Get the album cover image path.
     */
    public function getAlbumCoverPath(): ?string;

    /**
     * Get the release date.
     */
    public function getReleasedAt(): ?string;
}
