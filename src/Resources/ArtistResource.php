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
     * print $song->title;
     * print $song->title;
     * //=> Ditto
     * print $song->album_id;
     * //=> 11127145
     * print $song->artwork_image_path;
     * //=> https://cdnimg.melon.co.kr/cm2/album/images/111/27/145/11127145_20231213133532_500.jpg?42f8389c13de0f5f8e4c722bbb0d4bd7/melon/resize/144/optimize/90
     */
    public static function make(MelonArtist $melonArtist): static
    {
        return new static($melonArtist);
    }
}
