<?php

namespace Cable8mm\WaterMelon\Resources;

use Cable8mm\WaterMelon\Contracts\ArtistResourceInterface;
use Cable8mm\WaterMelon\MelonArtist;

/**
 * Artist resource with null for mapping from melon.com.
 *
 * @since  2023-03-20
 */
class ArtistNullResource extends Resource implements ArtistResourceInterface
{
    /**
     * {@inheritDoc}
     *
     * Additionally, ArtistNullResource attributes are returned.
     */
    public function toArray(): array
    {
        return [
            'melon_artistid' => $this->melon['ARTISTID'],
            'name' => $this->melon['ARTISTNAME'],
            'featured_image_path' => self::emptyToNull($this->melon['ARTISTIMGLARGE']),
            'profile_image_path' => self::emptyToNull($this->melon['POSTIMG']),
            'birth' => null,
            'sns' => null,
            'debut' => $this->melon['ARTISTNOTEINFO']['ISSUEDATE'] ?? null,
            'activity_regiment' => null,
            'activity_type' => null,
            'agency' => null,
            'genre' => null,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getMelonArtistId(): int
    {
        return $this->melon['ARTISTID'];
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return $this->melon['ARTISTNAME'];
    }

    /**
     * {@inheritDoc}
     */
    public function getFeaturedImagePath(): ?string
    {
        return self::emptyToNull($this->melon['ARTISTIMGLARGE']);
    }

    /**
     * {@inheritDoc}
     */
    public function getProfileImagePath(): ?string
    {
        return self::emptyToNull($this->melon['POSTIMG']);
    }

    /**
     * {@inheritDoc}
     */
    public function getDebut(): ?string
    {
        return $this->melon['ARTISTNOTEINFO']['ISSUEDATE'] ?? null;
    }

    /**
     * Create a new ArtistNullResource instance.
     */
    public static function make(MelonArtist $melonArtist): static
    {
        return new static($melonArtist);
    }
}
