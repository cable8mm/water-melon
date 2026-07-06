<?php

namespace Cable8mm\WaterMelon\Contracts;

/**
 * Interface for artist resources.
 *
 * @since  2024-01-15
 */
interface ArtistResourceInterface
{
    /**
     * Get the resource as an array.
     */
    public function toArray(): array;

    /**
     * Get the artist ID.
     */
    public function getMelonArtistId(): int;

    /**
     * Get the artist name.
     */
    public function getName(): string;

    /**
     * Get the featured image path.
     */
    public function getFeaturedImagePath(): ?string;

    /**
     * Get the profile image path.
     */
    public function getProfileImagePath(): ?string;

    /**
     * Get the debut date.
     */
    public function getDebut(): ?string;
}
