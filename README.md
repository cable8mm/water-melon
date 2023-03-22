# Water Melon

Water Melon 프로젝트는 멜론 ID로 멜론 정보를 조회할 수 있는 라이브러리입니다.

## Installation

```sh
composer require cable8mm/water-melon
```

## Usage

Get song info:

```php
$song = MelonSong::make(35945927);

print $song['SONGINFO']['SONGNAME'];

// print Ditto

$album = MelonAlbum::make(11127145);

print $album['ALBUMINFO']['ALBUMNAME'];

// print NewJeans 'OMG'

$artist = MelonArtist::make(3114174);

print $artist['ARTISTNAME'];

// print NewJeans
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
