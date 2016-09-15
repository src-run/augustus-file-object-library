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
 * Provides permissions object for {@see StorageObjectInterface}.
 */
class PermissionAccessors extends AbstractAccessors
{
    /**
     * Returns whether object is readable.
     *
     * @return bool
     */
    final public function isReadable()
    {
        return $this->provider->isReadable();
    }

    /**
     * Returns whether object is writable.
     *
     * @return bool
     */
    final public function isWritable()
    {
        return $this->provider->isWritable();
    }
}

/* EOF */
