<?php

namespace Cable8mm\WaterMelon;

use Cable8mm\WaterMelon\Contracts\ArtistInterface;
use Cable8mm\WaterMelon\Exceptions\MelonApiException;
use Cable8mm\WaterMelon\Resources\ArtistNullResource;
use GuzzleHttp\Exception\RequestException;

/**
 * Fetches information about a artist from the melon.com API.
 *
 * @since  2023-03-20
 */
class MelonArtist extends Melon implements ArtistInterface
{
    /**
     * {@inheritDoc}
     *
     * @throws MelonApiException
     */
    public function parse(): array
    {
        if ($this->response) {
            return $this->response;
        }

        $url = "https://m2.melon.com/m6/v3/artist/home/basicInfo.json?artistId={$this->id}";

        try {
            $response = $this->client->request('GET', $url);
            $body = $response->getBody()->getContents();

            if (empty($body)) {
                throw MelonApiException::emptyResponse($url);
            }

            $json = json_decode($body, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw MelonApiException::jsonParseError($url, json_last_error_msg());
            }

            if (! isset($json['response'])) {
                throw MelonApiException::invalidResponse('response');
            }

            return $this->response = $json['response'];
        } catch (RequestException $e) {
            throw MelonApiException::requestFailed($url, $e->getMessage());
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return $this->response['ARTISTNAME'] ?? '';
    }

    /**
     * {@inheritDoc}
     */
    public function getFeaturedImagePath(): ?string
    {
        return ArtistNullResource::emptyToNull($this->response['ARTISTIMGLARGE'] ?? null);
    }

    /**
     * {@inheritDoc}
     */
    public function getProfileImagePath(): ?string
    {
        return ArtistNullResource::emptyToNull($this->response['POSTIMG'] ?? null);
    }

    /**
     * {@inheritDoc}
     */
    public function getBirth(): ?string
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getDebut(): ?string
    {
        return $this->response['ARTISTNOTEINFO']['ISSUEDATE'] ?? null;
    }

    /**
     * {@inheritDoc}
     */
    public function getAgency(): ?string
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getGenre(): ?string
    {
        return null;
    }
}
