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

use SR\File\Object\Provider\StorageObjectProviderInterface;

/**
 * Base storage object metadata class.
 */
abstract class AbstractAccessors
{
    /**
     * @var StorageObjectProviderInterface
     */
    protected $provider;

    /**
     * Construct using object provider instance.
     *
     * @param StorageObjectProviderInterface $provider
     */
    final public function __construct(StorageObjectProviderInterface $provider)
    {
        $this->provider = $provider;
    }
}

/* EOF */
