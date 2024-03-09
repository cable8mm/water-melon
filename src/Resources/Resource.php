<?php

namespace Cable8mm\WaterMelon\Resources;

use ArrayAccess;
use Cable8mm\WaterMelon\Melon;

/**
 * Resource class for general melon resources.
 *
 * @since  2023-03-20
 */
abstract class Resource implements ArrayAccess
{
    /** @var Melon General melon resource class. */
    public Melon $melon;

    /** @var array ArrayAccess implementation. */
    protected array $container = [];

    /**
     * To get resource as array.
     */
    abstract protected function toArray(): array;

    /**
     * Constructor.
     *
     * @param  Melon  $melon  Melon class instance
     */
    public function __construct(Melon $melon)
    {
        $this->melon = $melon;

        $this->container = $this->toArray();
    }

    /**
     *  Reading data from inaccessible (protected or private) or non-existing properties.
     */
    public function __get(mixed $name): mixed
    {
        return $this->container[$name];
    }

    /**
     * ArrayAccess implementation.
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * ArrayAccess implementation.
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * ArrayAccess implementation.
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * ArrayAccess implementation.
     */
    public function offsetGet(mixed $offset): mixed
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Infer the default image for Melon as null
     *
     * @param  ?string  $path  The path from Melon.
     * @return ?string If it is default image, return null.
     *
     * @example https://cdnimg.melon.co.kr/resource/mobile40/cds/common/image/sns_post_default_500.jpg
     */
    public static function emptyToNull(?string $path): ?string
    {
        return empty($path) || preg_match('/_default_[^\/]+\.jpg/', $path) ? null : $path;
    }
}
