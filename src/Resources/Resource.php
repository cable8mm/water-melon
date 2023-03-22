<?php

namespace Cable8mm\WaterMelon\Resources;

use ArrayAccess;
use Cable8mm\WaterMelon\Melon;
use Cable8mm\WaterMelon\Traits\Makeable;

abstract class Resource implements ArrayAccess
{
    use Makeable;

    public Melon $melon;

    public array $container = [];

    abstract protected function toArray();

    public function __construct($melon)
    {
        $this->melon = $melon;

        $this->container = $this->toArray();
    }

    public function __get($name)
    {
        return $this->container[$name];
    }

    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    public function offsetGet($offset): mixed
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
}
