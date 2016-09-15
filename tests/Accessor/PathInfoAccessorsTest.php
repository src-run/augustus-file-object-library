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
 * @covers \SR\File\Object\Operation\PathInfoAccessors
 */
class PathInfoAccessorsTest extends AbstractTest
{
    public function setUp()
    {
        $this->removeTestLink();
    }

    public function tearDown()
    {
        $this->removeTestLink();
    }

    /**
     * @expectedException \SR\File\Object\Exception\NotFoundException
     */
    public function testThrowsExceptionOnRealPathOfFakeFile()
    {
        $provider = $this->createFileSystemStorageProviderInstance(new \SplFileInfo('/tmp/does/not/exist'));
        $pathInfo = $this->createStorageObjectPathInfoInstance($provider);

        $pathInfo->getPathName(true);
    }

    public function testGetFileName()
    {
        $this->assertSame(
            pathinfo($this->getProviderTestFile(), PATHINFO_FILENAME),
            $this->createStorageObjectPathInfoInstance()->getFileName()
        );
        $this->assertSame(
            pathinfo(realpath($this->getProviderTestFile()), PATHINFO_FILENAME),
            $this->createStorageObjectPathInfoInstance()->getFileName(true)
        );

        $provider = $this->createFileSystemStorageProviderInstance(new \SplFileInfo($link = $this->createTestLink()));
        $pathInfo = $this->createStorageObjectPathInfoInstance($provider);

        $this->assertSame(
            pathinfo($link, PATHINFO_FILENAME),
            $pathInfo->getFileName()
        );
        $this->assertSame(
            pathinfo(realpath($link), PATHINFO_FILENAME),
            $pathInfo->getFileName(true)
        );

        $this->removeTestLink();
    }

    public function testGetBaseName()
    {
        $expected = pathinfo($this->getProviderTestFile(), PATHINFO_BASENAME);

        $this->assertSame(
            $expected,
            $this->createStorageObjectPathInfoInstance()->getBaseName()
        );
        $this->assertSame(
            basename($expected, '.php'),
            $this->createStorageObjectPathInfoInstance()->getBaseName('php')
        );
        $this->assertSame(
            basename($expected, '.php'),
            $this->createStorageObjectPathInfoInstance()->getBaseName('.php')
        );

        $expected = pathinfo(realpath($this->getProviderTestFile()), PATHINFO_BASENAME);

        $this->assertSame(
            $expected,
            $this->createStorageObjectPathInfoInstance()->getBaseName(null, true)
        );
        $this->assertSame(
            basename($expected, '.php'),
            $this->createStorageObjectPathInfoInstance()->getBaseName('php', true)
        );
        $this->assertSame(
            basename($expected, '.php'),
            $this->createStorageObjectPathInfoInstance()->getBaseName('.php', true)
        );

        $provider = $this->createFileSystemStorageProviderInstance(new \SplFileInfo($link = $this->createTestLink()));
        $pathInfo = $this->createStorageObjectPathInfoInstance($provider);

        $this->assertSame(
            basename($link),
            $pathInfo->getBaseName()
        );
        $this->assertSame(
            basename(realpath($link), '.php5'),
            $pathInfo->getBaseName('.php5', true)
        );
        $this->assertSame(
            basename(realpath($link)),
            $pathInfo->getBaseName('.php', true)
        );

        $this->removeTestLink();
    }

    public function testGetFile()
    {
        $this->assertSame(
            $this->getProviderTestFile(),
            $this->createStorageObjectPathInfoInstance()->getFile()
        );
        $this->assertSame(
            realpath($this->getProviderTestFile()),
            $this->createStorageObjectPathInfoInstance()->getFile(true)
        );
    }

    public function testGetPathName()
    {
        $this->assertSame(
            $this->getProviderTestFile(),
            $this->createStorageObjectPathInfoInstance()->getPathName()
        );

        $this->assertSame(
            realpath($this->getProviderTestFile()),
            $this->createStorageObjectPathInfoInstance()->getPathName(true)
        );
    }

    public function testGetPath()
    {
        $this->assertSame(
            pathinfo($this->getProviderTestFile(), PATHINFO_DIRNAME),
            $this->createStorageObjectPathInfoInstance()->getPath()
        );
        $this->assertSame(
            pathinfo(realpath($this->getProviderTestFile()), PATHINFO_DIRNAME),
            $this->createStorageObjectPathInfoInstance()->getPath(true)
        );
    }

    public function testGetExtension()
    {
        $this->assertSame(
            pathinfo($this->getProviderTestFile(), PATHINFO_EXTENSION),
            $this->createStorageObjectPathInfoInstance()->getExtension()
        );
        $this->assertSame(
            pathinfo(realpath($this->getProviderTestFile()), PATHINFO_EXTENSION),
            $this->createStorageObjectPathInfoInstance()->getExtension(true)
        );
    }

    protected function getTestLinkName()
    {
        $directory = pathinfo($this->getProviderTestFile(), PATHINFO_DIRNAME);

        return $directory.DIRECTORY_SEPARATOR.'AbstractTestLink.php5';
    }

    protected function createTestLink()
    {
        link($this->getProviderTestFile(), $this->getTestLinkName());

        return $this->getTestLinkName();
    }

    protected function removeTestLink()
    {
        @unlink($this->getTestLinkName());
    }
}

/* EOF */
