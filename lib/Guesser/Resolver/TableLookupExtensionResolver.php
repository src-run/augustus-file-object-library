<?php

/*
 * This file is part of the `src-run/augustus-file-object-library` project.
 *
 * (c) Rob Frawley 2nd <rmf@src.run>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SR\File\Object\Guesser\Resolver;

use SR\Compiler\YmlCompiler;
use SR\File\Object\Guesser\Model\MimeType;
use SR\File\Object\StorageObjectInterface;

/**
 * Extension resolver using static YML data table.
 */
class TableLookupExtensionResolver extends AbstractResolver implements ExtensionResolverInterface
{
    /**
     * @var string
     */
    private $file;

    /**
     * Constructor can be optionally configured to use alternate yml lookup file.
     *
     * @param string $file
     */
    public function __construct($file = __DIR__.'/../../Resources/mimeTypeMapToFileExtension.yml')
    {
        $this->file = $file;
    }

    /**
     * Determine if resolver is supported and supports object.
     *
     * @param null|StorageObjectInterface $object
     *
     * @return bool
     */
    public function supports(StorageObjectInterface $object = null)
    {
        return true;
    }

    /**
     * Attempt to determine the extension of the object.
     *
     * @param StorageObjectInterface $object
     *
     * @return bool|MimeType
     */
    public function resolve(StorageObjectInterface $object)
    {
        $compiler = new YmlCompiler($this->file, new \DateInterval('PT2S'));
        $compiler->compile();

        /* @todo: write implementation */

//        var_dump($compiler->get());
    }
}

/* EOF */
