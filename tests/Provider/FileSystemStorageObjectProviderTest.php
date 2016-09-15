<?php

/*
 * This file is part of the `src-run/augustus-file-object-library` project.
 *
 * (c) Rob Frawley 2nd <rmf@src.run>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SR\File\Object\Tests\Provider;

use SR\File\Object\Tests\AbstractTest;

/**
 * @covers \SR\File\Object\Provider\FileSystemStorageObjectProvider
 */
class FileSystemStorageObjectProviderTest extends AbstractTest
{
    public function testExists()
    {
        $provider = $this->createFileSystemStorageProviderInstance();

        $this->assertTrue($provider->exists());
    }
}

/* EOF */
