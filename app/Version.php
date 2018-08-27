<?php

namespace App;

class Version
{
    protected $x;

    protected $y;

    protected $z;

    public function __construct($versionString)
    {
        preg_match('/([0-9])+\.([0-9])+\.?([0-9])?/', $versionString, $match);

        array_shift($match);
        $this->x = isset($match[0]) ? (int)$match[0] : null;
        $this->y = isset($match[1]) ? (int)$match[1] : null;
        $this->z = isset($match[2]) ? (int)$match[2] : null;
    }

    public function __toString()
    {
        $versionParts = array_filter([
            $this->x,
            $this->y,
            $this->z,
        ], function ($value) {
            return !is_null($value);
        });

        return implode('.', $versionParts);
    }
}
