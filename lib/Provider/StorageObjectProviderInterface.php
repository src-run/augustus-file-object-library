<?php

/*
 * This file is part of the `src-run/augustus-file-object-library` project.
 *
 * (c) Rob Frawley 2nd <rmf@src.run>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SR\File\Object\Provider;

use SR\File\Object\Guesser\Resolver\MimeTypeResolverInterface;

/**
 * Interface that describes classes representing a file object provider.
 */
interface StorageObjectProviderInterface
{
    const TYPE_FILE = 'file';
    const TYPE_DIRECTORY = 'directory';
    const TYPE_UNKNOWN = 'unknown';

    /**
     * Returns the mime type guessers supported by object type.
     *
     * @return MimeTypeResolverInterface[]
     */
    public function getMimeTypeGuessers();

    /**
     * Returns the object identifier.
     *
     * @return mixed
     */
    public function getIdentifier();

    /**
     * Returns the object URL.
     *
     * @return string
     */
    public function getUrl();

    /**
     * Returns the object's full path name.
     *
     * @return string
     */
    public function getPathName();

    /**
     * Returns the object's real full path name.
     *
     * @return string
     */
    public function getRealPathName();

    /**
     * Returns whether object exists on storage medium.
     *
     * @return bool
     */
    public function exists();

    /**
     * Returns the file type.
     *
     * @return string
     */
    public function getType();

    /**
     * Returns whether object type is a file.
     *
     * @return bool
     */
    public function isFile();

    /**
     * Returns whether object type is a directory.
     *
     * @return bool
     */
    public function isDirectory();

    /**
     * Returns whether object type is a link.
     *
     * @return bool
     */
    public function isLink();

    /**
     * Returns whether object type is a executable.
     *
     * @return bool
     */
    public function isExecutable();

    /**
     * Returns whether object is locally stored.
     *
     * @return bool
     */
    public function isLocal();

    /**
     * Returns the object's size in bytes.
     *
     * @return int
     */
    public function getSizeAsBytes();

    /**
     * Returns the object owning user.
     *
     * @return int
     */
    public function getOwningUser();

    /**
     * Returns the object owning group.
     *
     * @return int
     */
    public function getOwningGroup();

    /**
     * Returns the object permissions.
     *
     * @return int
     */
    public function getPermissionsAsOctal();

    /**
     * Returns whether object is readable.
     *
     * @return bool
     */
    public function isReadable();

    /**
     * Returns whether object is writable.
     *
     * @return bool
     */
    public function isWritable();

    /**
     * Returns the unix time the object was created.
     *
     * @return int
     */
    public function getCreatedAsUnixTime();

    /**
     * Returns the unix time the object was accessed.
     *
     * @return int
     */
    public function getAccessedAsUnixTime();

    /**
     * Returns the unix time the object was modified.
     *
     * @return int
     */
    public function getModifiedAsUnixTime();

    /**
     * Read contents from the object.
     *
     * @return string
     */
    public function getContent();

    /**
     * Write contents to the object.
     *
     * @param string $contents
     *
     * @return string
     */
    public function setContent($contents);
}

/* EOF */
