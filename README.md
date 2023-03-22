[![PHP Linting (Pint)](https://github.com/cable8mm/water-melon/actions/workflows/lint.yml/badge.svg)](https://github.com/cable8mm/water-melon/actions/workflows/lint.yml) [![Latest Stable Version](http://poser.pugx.org/cable8mm/water-melon/v)](https://packagist.org/packages/cable8mm/water-melon) [![Total Downloads](http://poser.pugx.org/cable8mm/water-melon/downloads)](https://packagist.org/packages/cable8mm/water-melon) [![Latest Unstable Version](http://poser.pugx.org/cable8mm/water-melon/v/unstable)](https://packagist.org/packages/cable8mm/water-melon) [![License](http://poser.pugx.org/cable8mm/water-melon/license)](https://packagist.org/packages/cable8mm/water-melon) [![PHP Version Require](http://poser.pugx.org/cable8mm/water-melon/require/php)](https://packagist.org/packages/cable8mm/water-melon)

# Water Melon

Water Melon 프로젝트는 멜론 ID로 멜론 정보를 조회할 수 있는 라이브러리입니다.

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

멜론에서 보내는 Key/Value는 docs폴더의 문서를 참고하세요.

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
