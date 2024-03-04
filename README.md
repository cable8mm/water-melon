[![PHP Linting (Pint)](https://github.com/cable8mm/water-melon/actions/workflows/lint.yml/badge.svg)](https://github.com/cable8mm/water-melon/actions/workflows/lint.yml)
[![Build & Test](https://github.com/cable8mm/water-melon/actions/workflows/php.yml/badge.svg)](https://github.com/cable8mm/water-melon/actions/workflows/php.yml)
![Packagist Downloads](https://img.shields.io/packagist/dt/cable8mm/water-melon)
![Packagist Version](https://img.shields.io/packagist/v/cable8mm/water-melon)
![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/cable8mm/water-melon/php)
![Packagist Stars](https://img.shields.io/packagist/stars/cable8mm/water-melon)
![Packagist License](https://img.shields.io/packagist/l/cable8mm/water-melon)

# Water Melon

This library is designed for retrieving information about artists, songs, and albums using their respective IDs from https://www.melon.com.

## Installation

```sh
composer require cable8mm/water-melon
```

## Usage

Get song info:

```php
$waterMelon = WaterMelon::make(35945927);   // Ditto's song id

print $waterMelon->song->id;

// print 35945927

print $waterMelon->album->id;

// print 11127145

print $waterMelon->artists[0]->id;

// print 3114174
```

and fantastic resource inspired by laravel resource:

```php
$waterMelon = WaterMelon::make(35945927);   // Ditto's song id

$song = SongResource::make($waterMelon->song);

print $song->title;
print $song->album_id;
print $song->artwork_image_path;

$artist = ArtistResource::make($waterMelon->artists[0]);

print $artistResource->melon_artistid;
print $artistResource->name;
print $artistResource->featured_image_path;

$album = AlbumResource::make($waterMelon->album);

print $albumResource->melon_albumid;
print $albumResource->title;
print $albumResource->album_cover_path;
print $albumResource->released_at;
```

## Specification

You can refer to the Markdown documents for melon.com JSON specifications:

- [Song Document](docs/song.md)
- [Album Document](docs/album.md)
- [Artist Document](docs/artist.md)

## Lint

```sh
composer lint
```

## Test

```sh
composer test
```

## License

The Water Melon project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
