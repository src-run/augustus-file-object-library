<?php

/*
 * This file is part of the `src-run/augustus-file-object-library` project.
 *
 * (c) Rob Frawley 2nd <rmf@src.run>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SR\File\Object\Tests;

use SR\File\Object\Operation\AbstractAccessors;
use SR\File\Object\Operation\ContextAccessors;
use SR\File\Object\Operation\DateTimeAccessors;
use SR\File\Object\Operation\OwnerAccessors;
use SR\File\Object\Operation\PathInfoAccessors;
use SR\File\Object\Operation\PermissionAccessors;
use SR\File\Object\Operation\SizeAccessors;
use SR\File\Object\Operation\UuidAccessors;
use SR\File\Object\Provider\FileSystemStorageObjectProvider;
use SR\File\Object\Provider\StorageObjectProviderInterface;

/**
 * Base test class for tests.
 */
abstract class AbstractTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param int $size
     *
     * @return string
     */
    protected function writeTemporaryFile($size)
    {
        $file = tempnam(sys_get_temp_dir(), 'phpunit-test');
        $handle = fopen($file, 'w');
        fseek($handle, $size - 1, SEEK_CUR);
        fwrite($handle, 'a');
        fclose($handle);

        return $file;
    }

    /**
     * @param string $file
     */
    protected function removeTemporaryFile($file)
    {
        unlink($file);
    }

    /**
     * @return string
     */
    protected function getProviderTestFile()
    {
        return __FILE__;
    }

    /**
     * @param \SplFileInfo|null $argument
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|FileSystemStorageObjectProvider
     */
    protected function createFileSystemStorageProviderInstance(\SplFileInfo $argument = null)
    {
        if (!$argument) {
            $argument = new \SplFileInfo($this->getProviderTestFile());
        }

        return new FileSystemStorageObjectProvider($argument);
    }

    /**
     * @param StorageObjectProviderInterface $argument
     *
     * @return OwnerAccessors
     */
    protected function createStorageObjectOwnerInstance(StorageObjectProviderInterface $argument = null)
    {
        if (!$argument) {
            $argument = $this->createFileSystemStorageProviderInstance();
        }

        return new OwnerAccessors($argument);
    }

    /**
     * @param StorageObjectProviderInterface $argument
     * @param string[]                       $methods
     *
     * @return OwnerAccessors|\PHPUnit_Framework_MockObject_MockObject
     */
    protected function createStorageObjectOwnerMock(StorageObjectProviderInterface $argument = null, array $methods = [])
    {
        if (!$argument) {
            $argument = $this->createFileSystemStorageProviderInstance();
        }

        return $this
            ->getMockBuilder(OwnerAccessors::class)
            ->setMethods($methods)
            ->setConstructorArgs([$argument])
            ->getMock();
    }

    /**
     * @param StorageObjectProviderInterface $argument
     *
     * @return UuidAccessors
     */
    protected function createStorageObjectUuidInstance(StorageObjectProviderInterface $argument = null)
    {
        if (!$argument) {
            $argument = $this->createFileSystemStorageProviderInstance();
        }

        return new UuidAccessors($argument);
    }

    /**
     * @param StorageObjectProviderInterface $argument
     *
     * @return SizeAccessors
     */
    protected function createStorageObjectSizeInstance(StorageObjectProviderInterface $argument = null)
    {
        if (!$argument) {
            $argument = $this->createFileSystemStorageProviderInstance();
        }

        return new SizeAccessors($argument);
    }

    /**
     * @param StorageObjectProviderInterface $argument
     *
     * @return DateTimeAccessors
     */
    protected function createStorageObjectTimeInstance(StorageObjectProviderInterface $argument = null)
    {
        if (!$argument) {
            $argument = $this->createFileSystemStorageProviderInstance();
        }

        return new DateTimeAccessors($argument);
    }

    /**
     * @param StorageObjectProviderInterface $argument
     *
     * @return PermissionAccessors
     */
    protected function createStorageObjectPermissionsInstance(StorageObjectProviderInterface $argument = null)
    {
        if (!$argument) {
            $argument = $this->createFileSystemStorageProviderInstance();
        }

        return new PermissionAccessors($argument);
    }

    /**
     * @param StorageObjectProviderInterface $argument
     *
     * @return ContextAccessors
     */
    protected function createStorageObjectTypeInstance(StorageObjectProviderInterface $argument = null)
    {
        if (!$argument) {
            $argument = $this->createFileSystemStorageProviderInstance();
        }

        return new ContextAccessors($argument);
    }

    /**
     * @param StorageObjectProviderInterface $argument
     * @param string[]                       $methods
     *
     * @return AbstractAccessors|\PHPUnit_Framework_MockObject_MockObject
     */
    protected function createAbstractStorageObjectMetadataMock(StorageObjectProviderInterface $argument = null, array $methods = [])
    {
        if (!$argument) {
            $argument = $this->createFileSystemStorageProviderInstance();
        }

        return $this
            ->getMockBuilder(AbstractAccessors::class)
            ->setMethods($methods)
            ->setConstructorArgs([$argument])
            ->getMockForAbstractClass();
    }

    /**
     * @param StorageObjectProviderInterface $argument
     *
     * @return PathInfoAccessors
     */
    protected function createStorageObjectPathInfoInstance(StorageObjectProviderInterface $argument = null)
    {
        if (!$argument) {
            $argument = $this->createFileSystemStorageProviderInstance();
        }

        return new PathInfoAccessors($argument);
    }
}

/* EOF */
