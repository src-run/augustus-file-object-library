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

/**
 * Interface that describes a class representing a file object, regardless of location or storage backend.
 */
interface StorageObjectInterface
{
    /**
     * Returns the object path name {@see StorageObjectInterface::getPathName()}.
     *
     * @return string
     */
    public function __toString();

    /**
     * Returns whether object exists on storage medium.
     *
     * @return bool
     */
    public function exists();

    /**
     * Returns an object file identifier.
     *
     * @return mixed
     */
    public function getIdentifier();

    /**
     * Returns the object file url.
     *
     * @return string
     */
    public function getUrl();

    /**
     * Returns the object path info metadata instance.
     *
     * @return PathInfoAccessors
     */
    public function getPathInfo();

    /**
     * Returns the object type metadata instance.
     *
     * @return ContextAccessors
     */
    public function getContext();

    /**
     * Returns an object mime type metadata instance.
     *
     * @return MimeTypeAccessors
     */
    public function getMimeType();

    /**
     * Returns an object uuid metadata instance.
     *
     * @return UuidAccessors
     */
    public function getUuid();

    /**
     * Returns an object size metadata instance.
     *
     * @return SizeAccessors
     */
    public function getSize();

    /**
     * Returns an object owner metadata instance.
     *
     * @return OwnerAccessors
     */
    public function getOwner();

    /**
     * Returns an object permissions metadata instance.
     *
     * @return PermissionAccessors
     */
    public function getPermissions();

    /**
     * Returns an object time metadata instance.
     *
     * @return DateTimeAccessors
     */
    public function getTime();

    /**
     * Returns the object file contents.
     *
     * @return string
     */
    public function getContents();

    /**
     * Sets and returns the object file contents.
     *
     * @param string $contents
     *
     * @return string
     */
    public function setContents($contents);
}

/* EOF */
