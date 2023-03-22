<?php

namespace Cable8mm\WaterMelon;

use ArrayAccess;
use Cable8mm\WaterMelon\Traits\Makeable;

abstract class Melon implements ArrayAccess
{
    use Makeable;

    public int $id;

    protected array $response = [];

    abstract protected function parse();

    public function __construct(int $id, $autoParse = true)
    {
        $this->id = $id;

        if ($autoParse) {
            $this->parse();
        }
    }

    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->response[] = $value;
        } else {
            $this->response[$offset] = $value;
        }
    }

    public function offsetExists($offset): bool
    {
        return isset($this->response[$offset]);
    }

    public function offsetUnset($offset): void
    {
        unset($this->response[$offset]);
    }

    public function offsetGet($offset): mixed
    {
        return isset($this->response[$offset]) ? $this->response[$offset] : null;
    }
}
