<?php

namespace Cable8mm\WaterMelon\Resources;

class ArtistResource extends Resource
{
    public function toArray()
    {
        // TODO : birth, sns, activity_regiment, activity_type, agency, genre
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
}
