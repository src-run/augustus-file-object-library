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

use Ramsey\Uuid\Uuid;

/**
 * Provides UUID-generating object for {@see StorageObjectInterface}.
 */
class UuidAccessors extends AbstractAccessors
{
    /**
     * @return \Ramsey\Uuid\UuidInterface
     */
    public function getVersion3()
    {
        return Uuid::uuid3(Uuid::NAMESPACE_URL, $this->provider->getUrl());
    }

    /**
     * @return \Ramsey\Uuid\UuidInterface
     */
    public function getVersion5()
    {
        return Uuid::uuid5(Uuid::NAMESPACE_URL, $this->provider->getUrl());
    }
}

/* EOF */
