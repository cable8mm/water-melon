<?php

namespace Cable8mm\WaterMelon\Resources;

use Cable8mm\WaterMelon\MelonArtist;

/**
 * Artist resource for mapping from melon.com.
 *
 * @since  2023-03-20
 */
class ArtistResource extends Resource
{
    /**
     * {@inheritDoc}
     *
     * Additionally, ArtistResource attributes are returned.
     */
    public function toArray(): array
    {
        return [
            'melon_artistid' => $this->melon['ARTISTID'],
            'name' => $this->melon['ARTISTNAME'],
            'featured_image_path' => $this->melon['ARTISTIMGLARGE'],
            'profile_image_path' => $this->melon['POSTIMG'],
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
     * Create a new ArtistResource instance.
     *
     * @example $artist = ArtistResource::make($waterMelon->getArtists()[0]);
     * print $artist->name;
     * //=> NewJeans
     * print $artist->melon_artistid;
     * //=> 3114174
     * print $artist->featured_image_path;
     * //=> https://cdnimg.melon.co.kr/cm2/artistcrop/images/031/14/174/3114174_20231219153524_500.jpg?8d4887c3dea0a5262fe256c1aef2a9d2/melon/resize/100/optimize/90
     */
    public static function make(MelonArtist $melonArtist): static
    {
        return new static($melonArtist);
    }
}
