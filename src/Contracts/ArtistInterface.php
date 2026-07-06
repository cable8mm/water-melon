<?php

namespace Cable8mm\WaterMelon\Contracts;

use ArrayAccess;

/**
 * Interface for artist resources.
 *
 * @since  2024-01-15
 */
interface ArtistInterface extends ArrayAccess
{
    /**
     * Parse the resource data.
     */
    public function parse(): array;

    /**
     * Get the artist ID.
     */
    public function getId(): int;

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
     * Get the birth date.
     */
    public function getBirth(): ?string;

    /**
     * Get the debut date.
     */
    public function getDebut(): ?string;

    /**
     * Get the agency.
     */
    public function getAgency(): ?string;

    /**
     * Get the genre.
     */
    public function getGenre(): ?string;
}
