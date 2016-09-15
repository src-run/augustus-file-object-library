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

use Ramsey\Uuid\Uuid;
use SR\File\Object\Tests\AbstractTest;

/**
 * @covers \SR\File\Object\Operation\AbstractAccessors
 * @covers \SR\File\Object\Operation\UuidAccessors
 */
class UuidAccessorsTest extends AbstractTest
{
    public function testGetVersion3Uuid()
    {
        $provider = $this->createFileSystemStorageProviderInstance();
        $instance = $this->createStorageObjectUuidInstance($provider);
        $uuid = Uuid::uuid3(Uuid::NAMESPACE_URL, $provider->getUrl());

        $this->assertSame($uuid->toString(), $instance->getVersion3()->toString());
        $this->assertInstanceOf(Uuid::class, $instance->getVersion3());
    }

    public function testGetVersion5Uuid()
    {
        $provider = $this->createFileSystemStorageProviderInstance();
        $instance = $this->createStorageObjectUuidInstance($provider);
        $uuid = Uuid::uuid5(Uuid::NAMESPACE_URL, $provider->getUrl());

        $this->assertSame($uuid->toString(), $instance->getVersion5()->toString());
        $this->assertInstanceOf(Uuid::class, $instance->getVersion5());
    }
}

/* EOF */
