<?php

/*
 * This file is part of the `src-run/augustus-file-object-library` project.
 *
 * (c) Rob Frawley 2nd <rmf@src.run>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SR\File\Object\Guesser\Resolver;

use SR\File\Object\StorageObjectInterface;

/**
 * Interface for generic resolver implementation.
 */
interface ResolverInterface
{
    /**
     * Determine if resolver is supported and supports object.
     *
     * @param null|StorageObjectInterface $object
     *
     * @return bool
     */
    public function supports(StorageObjectInterface $object = null);

    /**
     * Attempt to determine the mime type of the file object.
     *
     * @param StorageObjectInterface $object
     *
     * @return bool|mixed
     */
    public function resolve(StorageObjectInterface $object);
}

/* EOF */
