[![code-style](https://github.com/companimal/water-melon/actions/workflows/code-style.yml/badge.svg)](https://github.com/companimal/water-melon/actions/workflows/code-style.yml)
[![run-tests](https://github.com/companimal/water-melon/actions/workflows/run-tests.yml/badge.svg)](https://github.com/companimal/water-melon/actions/workflows/run-tests.yml)
![Packagist Version](https://img.shields.io/packagist/v/cable8mm/water-melon)
![Packagist Downloads](https://img.shields.io/packagist/dt/cable8mm/water-melon)
![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/cable8mm/water-melon/php)
![Packagist Stars](https://img.shields.io/packagist/stars/cable8mm/water-melon)
![Packagist License](https://img.shields.io/packagist/l/cable8mm/water-melon)

# Water Melon

This library is designed for retrieving information about artists, songs, and albums using their respective IDs from https://www.melon.com.

We have provided the API Documentation on the web. For more information, please visit https://www.palgle.com/water-melon/ ❤️

## Features

- [x] Fetches information about songs, artists, and albums
- [x] To be able to retrieve information about artists and albums using the Melon song ID
- [x] Customize the fields according to your needs for easy access

## Installation

```sh
composer require cable8mm/water-melon
```

## Usage

Get song info:

```php
$waterMelon = WaterMelon::make(35945927);   // Ditto's song id

print $waterMelon->song->id;
//=> 35945927

print $waterMelon->album->id;
//=> 11127145

print $waterMelon->artists[0]->id;
//=> 3114174
```

and fantastic resource inspired by laravel resource:

```php
$waterMelon = WaterMelon::make(35945927);
// Ditto's Melon song ID

$song = SongResource::make($waterMelon->getSong());

print $song->title;
//=> Ditto
print $song->album_id;
//=> 11127145
print $song->artwork_image_path;
//=> https://cdnimg.melon.co.kr/cm2/album/images/111/27/145/11127145_20231213133532_500.jpg?42f8389c13de0f5f8e4c722bbb0d4bd7/melon/resize/144/optimize/90

$artist = ArtistResource::make($waterMelon->getArtists()[0]);

print $artist->melon_artistid;
//=> 3114174
print $artist->name;
//=> NewJeans
print $artist->featured_image_path;
//=> https://cdnimg.melon.co.kr/cm2/artistcrop/images/031/14/174/3114174_20231219153524_500.jpg?8d4887c3dea0a5262fe256c1aef2a9d2/melon/resize/100/optimize/90

$album = AlbumResource::make($waterMelon->getAlbum());

print $album->melon_albumid;
//=> 11127145
print $album->title;
//=> NewJeans 'OMG'
print $album->album_cover_path;
//=> https://cdnimg.melon.co.kr/cm2/album/images/111/27/145/11127145_20231213133532_500.jpg?42f8389c13de0f5f8e4c722bbb0d4bd7/melon/resize/255/optimize/90
print $album->released_at;
//=> 2023.01.02
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
