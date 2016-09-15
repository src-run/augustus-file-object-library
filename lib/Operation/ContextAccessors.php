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
class ContextAccessors extends AbstractAccessors
{
    /**
     * Returns object type string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->provider->getType();
    }

    /**
     * Returns whether object type is a file.
     *
     * @return bool
     */
    final public function isFile()
    {
        return $this->provider->isFile();
    }

    /**
     * Returns whether object type is a directory.
     *
     * @return bool
     */
    final public function isDirectory()
    {
        return $this->provider->isDirectory();
    }

    /**
     * Returns whether object type is a link.
     *
     * @return bool
     */
    final public function isLink()
    {
        return $this->provider->isLink();
    }

    /**
     * Returns whether object type is a executable.
     *
     * @return bool
     */
    final public function isExecutable()
    {
        return $this->provider->isExecutable();
    }

    /**
     * Returns whether object is locally stored.
     *
     * @return bool
     */
    final public function isLocal()
    {
        return $this->provider->isLocal();
    }
}

/* EOF */
