<?php

namespace Cable8mm\WaterMelon\Traits;

trait MakeToArray
{
    /**
     * Create a new element.
     *
     * @return static
     */
    public static function make(...$arguments)
    {
        return new self(...$arguments);
    }
}
