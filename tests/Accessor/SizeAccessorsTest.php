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

use SR\File\Object\Operation\SizeAccessors;
use SR\File\Object\Tests\AbstractTest;

/**
 * @covers \SR\File\Object\Operation\AbstractAccessors
 * @covers \SR\File\Object\Operation\SizeAccessors
 */
class SizeAccessorsTest extends AbstractTest
{
    public function testGetSize()
    {
        $this->assertRegExp('{[0-9]+\.[0-9]+\s[KMGPEY]M?}', $this->createStorageObjectSizeInstance()->toString());
    }

    public function sizeDataProvider()
    {
        return [
            [SizeAccessors::SIZE_B,  10, '10 B', 10],
            [SizeAccessors::SIZE_KB, 10, '10 KB', 1024 * 10],
            [SizeAccessors::SIZE_MB, 10, '10 MB', 1024 * 1024 * 10],
            [SizeAccessors::SIZE_GB, 10, '10 GB', 1024 * 1024 * 1024 * 10],
        ];
    }

    /**
     * @dataProvider sizeDataProvider
     *
     * @param int    $unit
     * @param int    $intR
     * @param string $strR
     * @param int    $size
     */
    public function testSize($unit, $intR, $strR, $size)
    {
        $file = $this->writeTemporaryFile($size);
        $provider = $this->createFileSystemStorageProviderInstance(new \SplFileInfo($file));
        $instance = $this->createStorageObjectSizeInstance($provider);

        $this->assertSame((float) $size, $instance->toInteger());
        $this->assertSame((float) $size, $instance->toInteger(SizeAccessors::SIZE_B));
        $this->assertSame((float) $intR, $instance->toInteger($unit));
        $this->assertSame((float) $intR, $instance->toInteger(SizeAccessors::SIZE_AUTO));
        $this->assertSame($strR, (string) $instance);
        $this->assertSame($strR, $instance->toString($unit));
        $this->assertSame("$size B", $instance->toString(SizeAccessors::SIZE_B));

        $this->removeTemporaryFile($file);
    }
}

/* EOF */
