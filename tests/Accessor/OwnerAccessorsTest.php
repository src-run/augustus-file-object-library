<?php

/*
 * This file is part of the `src-run/augustus-file-object-library` project.
 *
 * (c) Rob Frawley 2nd <rmf@src.run>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SR\File\Object\Tests\Accessor;

use SR\File\Object\Tests\AbstractTest;

/**
 * @covers \SR\File\Object\Operation\AbstractAccessors
 * @covers \SR\File\Object\Operation\OwnerAccessors
 */
class OwnerAccessorsTest extends AbstractTest
{
    public function testGetUserIdentifier()
    {
        $this->assertRegExp('{[0-9]+}', (string) $this->createStorageObjectOwnerInstance()->getUserIdentifier());
    }

    public function testGetGroupIdentifier()
    {
        $this->assertRegExp('{[0-9]+}', (string) $this->createStorageObjectOwnerInstance()->getGroupIdentifier());
    }

    public function testGetUserName()
    {
        $this->assertRegExp('{[\w]+}', $this->createStorageObjectOwnerInstance()->getUserName());
    }

    public function testGetGroupName()
    {
        $this->assertRegExp('{[\w]+}', $this->createStorageObjectOwnerInstance()->getGroupName());
    }

    /**
     * @expectedException \SR\File\Object\Exception\MetadataException
     */
    public function testGetUserNameExceptionIfNoPosixExtension()
    {
        $mock = $this->createStorageObjectOwnerMock(null, ['hasPosixExtension']);
        $mock
            ->method('hasPosixExtension')
            ->willReturn(false);

        $mock->getUserName();
    }

    /**
     * @expectedException \SR\File\Object\Exception\MetadataException
     */
    public function testGetGroupNameExceptionIfNoPosixExtension()
    {
        $mock = $this->createStorageObjectOwnerMock(null, ['hasPosixExtension']);
        $mock
            ->method('hasPosixExtension')
            ->willReturn(false);

        $mock->getGroupName();
    }
}

/* EOF */
