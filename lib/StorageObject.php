<?php

/*
 * This file is part of the `src-run/augustus-file-object-library` project.
 *
 * (c) Rob Frawley 2nd <rmf@src.run>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SR\File\Object;

use SR\File\Object\Operation\ContextAccessors;
use SR\File\Object\Operation\DateTimeAccessors;
use SR\File\Object\Operation\MimeTypeAccessors;
use SR\File\Object\Operation\OwnerAccessors;
use SR\File\Object\Operation\PathInfoAccessors;
use SR\File\Object\Operation\PermissionAccessors;
use SR\File\Object\Operation\SizeAccessors;
use SR\File\Object\Operation\UuidAccessors;
use SR\File\Object\Provider\StorageObjectProviderInterface;

/**
 * File object representation.
 */
class StorageObject implements StorageObjectInterface
{
    /**
     * @var StorageObjectProviderInterface
     */
    private $provider;

    /**
     * Construct using object provider instance.
     *
     * @param StorageObjectProviderInterface $provider
     */
    final public function __construct(StorageObjectProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Returns the object path name {@see StorageObjectInterface::getPathName()}.
     *
     * @return string
     */
    final public function __toString()
    {
        return $this->getPathInfo()->getPathName();
    }

    /**
     * Returns whether object exists on storage medium.
     *
     * @return bool
     */
    final public function exists()
    {
        return $this->provider->exists();
    }

    /**
     * Returns an object file identifier.
     *
     * @return mixed
     */
    final public function getIdentifier()
    {
        return $this->provider->getIdentifier();
    }

    /**
     * Returns the object file url.
     *
     * @return string
     */
    final public function getUrl()
    {
        return $this->provider->getUrl();
    }

    /**
     * Returns the object path info metadata instance.
     *
     * @return PathInfoAccessors
     */
    final public function getPathInfo()
    {
        return new PathInfoAccessors($this->provider);
    }

    /**
     * Returns the object type metadata instance.
     *
     * @return ContextAccessors
     */
    final public function getContext()
    {
        return new ContextAccessors($this->provider);
    }

    /**
     * Returns a mime type metadata instance.
     *
     * @return MimeTypeAccessors
     */
    final public function getMimeType()
    {
        return new MimeTypeAccessors($this->provider);
    }

    /**
     * Returns a uuid metadata instance.
     *
     * @return UuidAccessors
     */
    final public function getUuid()
    {
        return new UuidAccessors($this->provider);
    }

    /**
     * Returns a size metadata instance.
     *
     * @return SizeAccessors
     */
    final public function getSize()
    {
        return new SizeAccessors($this->provider);
    }

    /**
     * Returns an owner metadata instance.
     *
     * @return OwnerAccessors
     */
    final public function getOwner()
    {
        return new OwnerAccessors($this->provider);
    }

    /**
     * Returns a permissions metadata instance.
     *
     * @return PermissionAccessors
     */
    final public function getPermissions()
    {
        return new PermissionAccessors($this->provider);
    }

    /**
     * Returns a time metadata instance.
     *
     * @return DateTimeAccessors
     */
    final public function getTime()
    {
        return new DateTimeAccessors($this->provider);
    }

    /**
     * Returns the object file contents.
     *
     * @return string
     */
    final public function getContents()
    {
        return $this->provider->getContent();
    }

    /**
     * Sets and returns the object file contents.
     *
     * @param string $contents
     *
     * @return string
     */
    final public function setContents($contents)
    {
        return $this->provider->setContent($contents);
    }
}

/* EOF */
