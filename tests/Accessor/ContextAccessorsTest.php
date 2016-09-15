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

use SR\File\Object\Provider\StorageObjectProviderInterface;
use SR\File\Object\Tests\AbstractTest;

/**
 * @covers \SR\File\Object\Operation\AbstractAccessors
 * @covers \SR\File\Object\Operation\ContextAccessors
 */
class ContextAccessorsTest extends AbstractTest
{
    public function testIsFile()
    {
        $this->assertTrue($this->createStorageObjectTypeInstance()->isFile());
    }

    public function testIsDirectory()
    {
        $this->assertFalse($this->createStorageObjectTypeInstance()->isDirectory());
    }

    public function testIsLink()
    {
        $this->assertFalse($this->createStorageObjectTypeInstance()->isLink());
    }

    public function testIsExecutable()
    {
        $this->assertTrue($this->createStorageObjectTypeInstance()->isExecutable());
    }

    public function testIsLocal()
    {
        $this->assertTrue($this->createStorageObjectTypeInstance()->isLocal());
    }

    public function testToString()
    {
        $this->assertSame(StorageObjectProviderInterface::TYPE_FILE, (string) $this->createStorageObjectTypeInstance());
    }
}

/* EOF */
