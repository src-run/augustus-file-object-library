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

use SR\File\Object\Exception\NotAccessibleException;
use SR\File\Object\Exception\NotFoundException;
use SR\File\Object\Exception\NotReadableException;
use SR\File\Object\Exception\NotWritableException;
use SR\Silencer\CallSilencer;

/**
 * Class representing a file system object provider.
 */
class FileSystemStorageObjectProvider extends AbstractStorageObjectProvider
{
    /**
     * @var \SplFileInfo
     */
    private $file;

    /**
     * Construction of the provider requires an {@see \SplFileInfo} instance.
     *
     * @param \SplFileInfo $file
     */
    public function __construct(\SplFileInfo $file)
    {
        $this->file = $file;
    }

    /**
     * Returns the object's full path name.
     *
     * @return string
     */
    public function getPathName()
    {
        return $this->file->getPathname();
    }

    /**
     * Returns the object's real full path name.
     *
     * @return string|bool
     */
    public function getRealPathName()
    {
        return realpath($this->getPathName());
    }

    /**
     * Returns whether object exists on storage medium.
     *
     * @return bool
     */
    public function exists()
    {
        return file_exists($this->getPathName());
    }

    /**
     * Returns whether object type is a file.
     *
     * @return bool
     */
    public function isFile()
    {
        return $this->file->isFile();
    }

    /**
     * Returns whether object type is a directory.
     *
     * @return bool
     */
    public function isDirectory()
    {
        return $this->file->isDir();
    }

    /**
     * Returns whether object type is a link.
     *
     * @return bool
     */
    public function isLink()
    {
        return $this->file->isLink();
    }

    /**
     * Returns whether object type is a executable.
     *
     * @return bool
     */
    public function isExecutable()
    {
        return $this->file->isExecutable();
    }

    /**
     * Returns whether object is locally stored.
     *
     * @return bool
     */
    public function isLocal()
    {
        return true;
    }

    /**
     * Returns the object's size in bytes.
     *
     * @return int
     */
    public function getSizeAsBytes()
    {
        return $this->file->getSize();
    }

    /**
     * Returns the object owning user.
     *
     * @return mixed
     */
    public function getOwningUser()
    {
        return $this->file->getOwner();
    }

    /**
     * Returns the object owning group.
     *
     * @return mixed
     */
    public function getOwningGroup()
    {
        return $this->file->getGroup();
    }

    /**
     * Returns the object permissions.
     *
     * @return int
     */
    public function getPermissionsAsOctal()
    {
        return $this->file->getPerms();
    }

    /**
     * Returns whether object is readable.
     *
     * @return bool
     */
    public function isReadable()
    {
        return $this->file->isReadable();
    }

    /**
     * Returns whether object is writable.
     *
     * @return bool
     */
    public function isWritable()
    {
        return $this->file->isWritable();
    }

    /**
     * Returns the unix time the object was created.
     *
     * @return int
     */
    public function getCreatedAsUnixTime()
    {
        return $this->file->getCTime();
    }

    /**
     * Returns the unix time the object was accessed.
     *
     * @return int
     */
    public function getAccessedAsUnixTime()
    {
        return $this->file->getATime();
    }

    /**
     * Returns the unix time the object was modified.
     *
     * @return int
     */
    public function getModifiedAsUnixTime()
    {
        return $this->file->getMTime();
    }

    /**
     * Read contents from the object.
     *
     * @throws NotFoundException
     * @throws NotAccessibleException
     * @throws NotReadableException
     *
     * @return string
     */
    public function getContent()
    {
        if (!$this->exists()) {
            throw new NotFoundException('File does not exist "%s"', $this->getPathName());
        }

        if (!$this->isReadable()) {
            throw new NotAccessibleException('File is not accessible "%s"', $this->getPathName());
        }

        $silencer = new CallSilencer();
        $silencer->setClosure(function () {
            return file_get_contents($this->getPathName());
        })->invoke();

        if ($silencer->isResultFalse() || $silencer->hasError()) {
            throw new NotWritableException('Could not write file contents "%s"', $silencer->getError(CallSilencer::ERROR_MESSAGE));
        }

        return $silencer->getResult();
    }

    /**
     * Write contents to the object.
     *
     * @param string $contents
     *
     * @throws NotFoundException
     * @throws NotAccessibleException
     * @throws NotWritableException
     *
     * @return string
     */
    public function setContent($contents)
    {
        if (!$this->exists()) {
            throw new NotFoundException('File does not exist "%s"', $this->getPathName());
        }

        if (!$this->isWritable()) {
            throw new NotAccessibleException('File is not accessible "%s"', $this->getPathName());
        }

        $silencer = new CallSilencer();
        $silencer->setClosure(function () use ($contents) {
            return file_put_contents($this->getPathName(), $contents);
        })->invoke();

        if ($silencer->isResultFalse() || $silencer->hasError()) {
            throw new NotWritableException('Could not write file contents "%s"', $silencer->getError(CallSilencer::ERROR_MESSAGE));
        }

        return $contents;
    }
}

/* EOF */
