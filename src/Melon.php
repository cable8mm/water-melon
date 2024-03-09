<?php

namespace Cable8mm\WaterMelon;

use ArrayAccess;
use Cable8mm\WaterMelon\Traits\Makeable;

/**
 * Abstract class for WaterMelon classes.
 *
 * @since  2023-03-20
 */
abstract class Melon implements ArrayAccess
{
    use Makeable;

    public int $id;

    protected array $response = [];

    /**
     * Fetches information about a song, a album or a artist from the melon.com API and saves it to $response and returns it.
     *
     * @return array An array of information about the song, album or artist.
     */
    abstract protected function parse(): array;

    /**
     * Class constructor.
     *
     * @param  int  $id  The id of the class
     * @param  bool  $autoParse  Automatically parse the response
     */
    public function __construct(int $id, $autoParse = true)
    {
        $this->id = $id;

        if ($autoParse) {
            $this->parse();
        }
    }

    /**
     * Setter for ArrayAccess.
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->response[] = $value;
        } else {
            $this->response[$offset] = $value;
        }
    }

    /**
     * Whether an offset exists
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->response[$offset]);
    }

    /**
     * Unset an offset
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->response[$offset]);
    }

    /**
     * Offset to retrieve
     */
    public function offsetGet(mixed $offset): mixed
    {
        return isset($this->response[$offset]) ? $this->response[$offset] : null;
    }
}
