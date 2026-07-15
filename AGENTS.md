# Water Melon - AI Agent Guide

## Overview

This library retrieves information about songs, artists, and albums from melon.com using Melon IDs. It provides both direct data access (via Melon classes) and a Laravel-style Resource layer for output transformation.

## Quick Start

```php
use Cable8mm\WaterMelon\WaterMelon;
use Cable8mm\WaterMelon\Resources\SongResource;
use Cable8mm\WaterMelon\Resources\AlbumResource;
use Cable8mm\WaterMelon\Resources\ArtistResource;

$waterMelon = WaterMelon::make(35945927); // Ditto's song ID

// Access raw Melon data
$waterMelon->song->id;         // 35945927
$waterMelon->song->getTitle(); // "Ditto"

$waterMelon->album->id;        // 11127145
$waterMelon->album->getTitle(); // "NewJeans 'OMG'"

$waterMelon->artists[0]->id;   // 3114174
$waterMelon->artists[0]->getName(); // "NewJeans"

// Use Resource layer for nice property access
SongResource::make($waterMelon->getSong())->title;  // "Ditto"
AlbumResource::make($waterMelon->getAlbum())->melon_albumid; // 11127145
ArtistResource::make($waterMelon->getArtists()[0])->name; // "NewJeans"

// Resources support ArrayAccess
$resource = SongResource::make($waterMelon->getSong());
$resource['title']; // "Ditto"

// Parse album/artists after construction (lazy loading)
$waterMelon->parse();
```

## Architecture

```
MelonSong ────┐
MelonAlbum ───┤──► WaterMelon (facade)
MelonArtist ──┘
     │
     ▼ (via getters)
SongResource   ◄── SongResource::make(MelonSong $song)
AlbumResource  ◄── AlbumResource::make(MelonAlbum $album)
ArtistResource ◄── ArtistResource::make(MelonArtist $artist)
```

### Data Flow

1. `WaterMelon::make(songId)` constructs `MelonSong`, `MelonAlbum`, `MelonArtist`
2. Each Melon class calls Melon API and stores raw response
3. Melon classes access raw array keys directly (`$this->response['SONGINFO']['SONGNAME']`)
4. Resource classes delegate to Melon getters (`$this->melon->getTitle()`)
5. Resource provides `__get()` magic property access and `ArrayAccess`

## Key Classes

### `WaterMelon` (src/WaterMelon.php)

Main facade. Created via `make()`.

| Method                               | Returns             | Description               |
| ------------------------------------ | ------------------- | ------------------------- |
| `make(int $songId, ?Client $client)` | `static`            | Factory method            |
| `parse()`                            | `static`            | Fetch album + artist data |
| `getSong()`                          | `SongInterface`     | MelonSong instance        |
| `getAlbum()`                         | `AlbumInterface`    | MelonAlbum instance       |
| `getArtists()`                       | `ArtistInterface[]` | MelonArtist array         |

**Properties** (populated after `make()`):

- `$waterMelon->song` → `MelonSong`
- `$waterMelon->album` → `MelonAlbum`
- `$waterMelon->artists` → `MelonArtist[]`

### `MelonSong` (src/MelonSong.php)

| Method                  | Returns   | Melon API Key                           |
| ----------------------- | --------- | --------------------------------------- |
| `getId()`               | `int`     | — (constructor param)                   |
| `getTitle()`            | `string`  | `SONGINFO.SONGNAME`                     |
| `getAlbumId()`          | `int`     | `SONGINFO.ALBUMID`                      |
| `getArtworkImagePath()` | `?string` | `SONGINFO.ALBUMIMG` (via `emptyToNull`) |

### `MelonAlbum` (src/MelonAlbum.php)

| Method                | Returns   | Melon API Key                            |
| --------------------- | --------- | ---------------------------------------- |
| `getId()`             | `int`     | — (constructor param)                    |
| `getTitle()`          | `string`  | `ALBUMINFO.ALBUMNAME`                    |
| `getAlbumCoverPath()` | `?string` | `ALBUMINFO.ALBUMIMG` (via `emptyToNull`) |
| `getReleasedAt()`     | `?string` | `ALBUMINFO.ISSUEDATE`                    |

### `MelonArtist` (src/MelonArtist.php)

| Method                   | Returns   | Melon API Key                        |
| ------------------------ | --------- | ------------------------------------ |
| `getId()`                | `int`     | — (constructor param)                |
| `getName()`              | `string`  | `ARTISTNAME`                         |
| `getFeaturedImagePath()` | `?string` | `ARTISTIMGLARGE` (via `emptyToNull`) |
| `getProfileImagePath()`  | `?string` | `POSTIMG` (via `emptyToNull`)        |
| `getBirth()`             | `?string` | Always `null`                        |
| `getDebut()`             | `?string` | `ARTISTNOTEINFO.ISSUEDATE`           |
| `getAgency()`            | `?string` | Always `null`                        |
| `getGenre()`             | `?string` | Always `null`                        |

## Contracts (Interfaces)

All in `src/Contracts/`:

| Interface                 | Methods                                                                                                                                       |
| ------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------- |
| `SongInterface`           | `parse()`, `getId()`, `getTitle()`, `getAlbumId()`, `getArtworkImagePath()`                                                                   |
| `AlbumInterface`          | `parse()`, `getId()`, `getTitle()`, `getAlbumCoverPath()`, `getReleasedAt()`                                                                  |
| `ArtistInterface`         | `parse()`, `getId()`, `getName()`, `getFeaturedImagePath()`, `getProfileImagePath()`, `getBirth()`, `getDebut()`, `getAgency()`, `getGenre()` |
| `SongResourceInterface`   | `toArray()`, `getMelonSongId()`, `getTitle()`, `getAlbumId()`, `getArtworkImagePath()`                                                        |
| `AlbumResourceInterface`  | `toArray()`, `getMelonAlbumId()`, `getTitle()`, `getAlbumCoverPath()`, `getReleasedAt()`                                                      |
| `ArtistResourceInterface` | `toArray()`, `getMelonArtistId()`, `getName()`, `getFeaturedImagePath()`, `getProfileImagePath()`, `getDebut()`                               |

## Resources

Resources wrap Melon objects and provide:

- `__get()` for magic property access (e.g., `$resource->title`)
- `ArrayAccess` (e.g., `$resource['title']`)
- `toArray()` for array serialization
- `make()` static factory method

### SongResource properties (via `toArray()`):

- `album_id`, `melon_songid`, `title`, `artwork_image_path`

### AlbumResource properties (via `toArray()`):

- `melon_albumid`, `title`, `album_cover_path`, `released_at`

### ArtistResource properties (via `toArray()`):

- `melon_artistid`, `name`, `featured_image_path`, `profile_image_path`, `birth`, `sns`, `debut`, `activity_regiment`, `activity_type`, `agency`, `genre`

## API Response Structure (Melon JSON Keys)

### Song (`SONGINFO`)

```
SONGINFO.ALBUMID    → album ID
SONGINFO.SONGID     → song ID
SONGINFO.SONGNAME   → song title
SONGINFO.ALBUMIMG   → album artwork URL
```

### Album (`ALBUMINFO`)

```
ALBUMINFO.ALBUMID   → album ID
ALBUMINFO.ALBUMNAME → album title
ALBUMINFO.ALBUMIMG  → album cover URL
ALBUMINFO.ISSUEDATE → release date
```

### Artist (root level)

```
ARTISTID           → artist ID
ARTISTNAME         → artist name
ARTISTIMGLARGE     → featured image URL
POSTIMG            → profile image URL
ARTISTNOTEINFO.ISSUEDATE → debut date
```

## `emptyToNull()` Behavior

The static method `Melon::emptyToNull(?string $path): ?string` converts default/empty melon image URLs to `null`. It checks:

- Empty strings
- URLs matching `_default_*.jpg` pattern

This is applied automatically to all image fields in Melon classes.

## Base Class `Melon` (src/Melon.php)

All Melon classes extend this:

- Constructor: `__construct(int $id, ?Client $client, bool $autoParse = true)`
- Factory: `make(int $id, ?Client $client, bool $autoParse = true): static`
- Implements `ArrayAccess` (wraps `$this->response`)
- `parse()` must be implemented by subclasses (calls Melon API)
- `emptyToNull()` available to all subclasses

## Error Handling

Exceptions extend `MelonApiException` (src/Exceptions/MelonApiException.php):

| Factory Method                  | When                          |
| ------------------------------- | ----------------------------- |
| `emptyResponse($url)`           | API returned empty body       |
| `jsonParseError($url, $error)`  | Invalid JSON response         |
| `invalidResponse($key)`         | Missing expected response key |
| `requestFailed($url, $message)` | HTTP request failed           |

## Testing

```bash
# Offline tests (no API calls)
composer test -- -c phpunit.offline.xml.dist

# All tests (including online API calls)
composer test
```

- Offline tests exclude `@group online` tests
- Online tests call real Melon API (may fail without network)

## Example: Working with multiple artists

```php
$waterMelon = WaterMelon::make(35945927); // Ditto
$waterMelon->parse(); // Fetch album + artist details

foreach ($waterMelon->getArtists() as $artist) {
    echo $artist->getName(); // "NewJeans"
    $resource = ArtistResource::make($artist);
    echo $resource->name; // "NewJeans"
}
```

## Example: Custom HTTP Client

```php
use GuzzleHttp\Client;

$client = new Client(['timeout' => 5]);
$waterMelon = WaterMelon::make(35945927, $client);
```
