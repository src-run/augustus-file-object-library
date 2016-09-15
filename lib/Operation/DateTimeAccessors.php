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
 * Provides time object for {@see StorageObjectInterface}.
 */
class DateTimeAccessors extends AbstractAccessors
{
    /**
     * Returns size as a human readable string {@see StorageObjectSize::getString()}.
     *
     * @return string
     */
    public function __toString()
    {
        $created = $this->getCreated()->format('r');
        $accessed = $this->getAccessed()->format('r');
        $modified = $this->getModified()->format('r');

        return sprintf('Created %s, Accessed %s, Modified %s', $created, $accessed, $modified);
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->createDateTime($this->provider->getCreatedAsUnixTime());
    }

    /**
     * @return \DateTime
     */
    public function getAccessed()
    {
        return $this->createDateTime($this->provider->getAccessedAsUnixTime());
    }

    /**
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->createDateTime($this->provider->getModifiedAsUnixTime());
    }

    /**
     * @param int $unixTime
     *
     * @return \DateTime
     */
    private function createDateTime($unixTime)
    {
        return new \DateTime('@'.$unixTime);
    }
}

/* EOF */
