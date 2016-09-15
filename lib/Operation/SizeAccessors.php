<?php

/*
 * This file is part of the `src-run/augustus-file-object-library` project.
 *
 * (c) Rob Frawley 2nd <rmf@src.run>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SR\File\Object\Operation;

/**
 * Provides size object for {@see StorageObjectInterface}.
 */
class SizeAccessors extends AbstractAccessors
{
    const SIZE_AUTO = 'A';
    const SIZE_B = 'B';
    const SIZE_KB = 'KB';
    const SIZE_MB = 'MB';
    const SIZE_GB = 'GB';
    const SIZE_TB = 'TB';
    const SIZE_PB = 'PB';
    const SIZE_EB = 'EB';
    const SIZE_YB = 'YB';

    /**
     * Returns size as a human readable string {@see StorageObjectSize::getString()}.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }

    /**
     * Returns the size as bytes.
     *
     * @param string $unit
     * @param int    $precision
     *
     * @return float
     */
    public function toInteger($unit = self::SIZE_B, $precision = 4)
    {
        list($size) = $this->getSize($unit === self::SIZE_AUTO ? null : $unit);

        return (float) round($size, $precision);
    }

    /**
     * Returns the size as a human readable string.
     *
     * @param string $unit
     * @param int    $precision
     *
     * @return string
     */
    public function toString($unit = self::SIZE_AUTO, $precision = 4)
    {
        list($size, $unit) = $this->getSize($unit === self::SIZE_AUTO ? null : $unit);

        return round($size, $precision).' '.$unit;
    }

    /**
     * @param null|string $unit
     *
     * @return string
     */
    private function getSize($unit = null)
    {
        $bytes = $this->provider->getSizeAsBytes();
        $units = [
            self::SIZE_B,
            self::SIZE_KB,
            self::SIZE_MB,
            self::SIZE_GB,
            self::SIZE_TB,
            self::SIZE_PB,
            self::SIZE_EB,
            self::SIZE_YB,
        ];

        if (!$unit || false === $index = array_search($unit, $units)) {
            $index = min(
                (floor(log($bytes) / log(1024))),
                (count($units) - 1)
            );
        }

        return [$bytes / pow(1024, $index), $units[$index], $index];
    }
}

/* EOF */
