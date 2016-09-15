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
 * Provides mime type object for {@see StorageObjectInterface}.
 */
class MimeTypeAccessors extends AbstractAccessors
{
    /**
     * Returns mime type string representation {@see StorageObjectMimeType::getTypeString()}.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getTypeString();
    }

    public function getTypeString()
    {
        return '';
    }
}

/* EOF */
