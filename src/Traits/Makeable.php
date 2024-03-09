<?php

namespace Cable8mm\WaterMelon\Traits;

/**
 * Factory class for creating traits.
 *
 * @since  2023-03-20
 */
trait Makeable
{
    /**
     * Create a new instance.
     */
    public static function make(...$arguments): static
    {
        return new static(...$arguments);
    }
}
