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

    public function increment($incrementalVersion): Version
    {
        if (!is_a($incrementalVersion, Version::class)) {
            $incrementalVersion = new static($incrementalVersion);
        }

        $versionNumbers = [];

        $versionNumbers[] = $this->getX() + $incrementalVersion->getX();
        $versionNumbers[] = $this->getY() + $incrementalVersion->getY();
        $versionNumbers[] = $this->getZ() + $incrementalVersion->getZ();

        return new self(implode('.', $versionNumbers));
    }

    public function getX(): ?int
    {
        return $this->x;
    }

    public function getY(): ?int
    {
        return $this->y;
    }

    public function getZ(): ?int
    {
        return $this->z;
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
