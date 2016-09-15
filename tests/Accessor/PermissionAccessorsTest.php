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
 * @covers \SR\File\Object\Operation\PermissionAccessors
 */
class PermissionAccessorsTest extends AbstractTest
{
    public function testIsReadable()
    {
        $this->assertTrue($this->createStorageObjectPermissionsInstance()->isReadable());
    }

    public function testIsWritable()
    {
        $this->assertTrue($this->createStorageObjectPermissionsInstance()->isWritable());
    }
}

/* EOF */
