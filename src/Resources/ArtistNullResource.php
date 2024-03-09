<?php

namespace Cable8mm\WaterMelon\Resources;

/**
 * Artist resource with null for mapping from melon.com.
 */
class ArtistNullResource extends Resource
{
    /**
     * {@inheritDoc}
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
}
