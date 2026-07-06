<?php

namespace Cable8mm\WaterMelon\Contracts;

/**
 * Interface for album resources.
 *
 * @since  2024-01-15
 */
interface AlbumResourceInterface
{
    /**
     * Get the resource as an array.
     */
    public function toArray(): array;

    /**
     * Get the album ID.
     */
    public function getMelonAlbumId(): int;

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
