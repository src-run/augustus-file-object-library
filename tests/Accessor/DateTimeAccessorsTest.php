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
 * @covers \SR\File\Object\Operation\DateTimeAccessors
 */
class DateTimeAccessorsTest extends AbstractTest
{
    public function testGetCreatedTime()
    {
        $tempFile = $this->writeTemporaryFile(1);
        $provider = $this->createFileSystemStorageProviderInstance(new \SplFileInfo($tempFile));
        $instance = $this->createStorageObjectTimeInstance($provider);
        $dateTime = new \DateTime();

        $this->assertSame($instance->getCreated()->format('r'), $dateTime->format('r'));
        $this->assertSame($instance->getAccessed()->format('r'), $dateTime->format('r'));
        $this->assertSame($instance->getModified()->format('r'), $dateTime->format('r'));
        $this->assertRegExp('{'.preg_quote($instance->getCreated()->format('r')).'}', (string) $instance);

        $this->removeTemporaryFile($tempFile);
    }
}

/* EOF */
