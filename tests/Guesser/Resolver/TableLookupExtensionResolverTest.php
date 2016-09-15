<?php

/*
 * This file is part of the `src-run/augustus-file-object-library` project.
 *
 * (c) Rob Frawley 2nd <rmf@src.run>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SR\File\Object\Tests\Guesser\Resolver;

use SR\File\Object\Guesser\Resolver\TableLookupExtensionResolver;
use SR\File\Object\Provider\FileSystemStorageObjectProvider;
use SR\File\Object\StorageObject;
use SR\File\Object\Tests\AbstractTest;

/**
 * @covers \SR\File\Object\Component\Compiler\YmlCompiler
 * @covers \SR\File\Object\Guesser\Resolver\TableLookupExtensionResolver
 */
class TableLookupExtensionResolverTest extends AbstractTest
{
    public function testConstruction()
    {
        $resolver = new TableLookupExtensionResolver();
        $resolver->supports(null);
        $resolver->resolve(new StorageObject(new FileSystemStorageObjectProvider(new \SplFileInfo(__FILE__))));
    }
}

/* EOF */
