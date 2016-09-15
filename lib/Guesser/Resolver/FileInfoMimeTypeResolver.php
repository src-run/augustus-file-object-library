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

use SR\File\Object\Guesser\Model\MimeType;
use SR\File\Object\StorageObjectInterface;

/**
 * Mime type resolver using file info extension.
 */
class FileInfoMimeTypeResolver extends AbstractResolver implements MimeTypeResolverInterface
{
    /**
     * @var null|string
     */
    private $magicFile;

    /**
     * FileInfoMimeTypeResolver constructor.
     *
     * @param null|string $magicFile
     */
    public function __construct($magicFile = null)
    {
        $this->magicFile = $magicFile;
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
        return function_exists('finfo_open') && $object->getContext()->isLocal();
    }

    /**
     * Attempt to determine the mime type of the object.
     *
     * @param StorageObjectInterface $object
     *
     * @return bool|MimeType
     */
    public function resolve(StorageObjectInterface $object)
    {
        if (!$this->supports($object)) {
            return false;
        }

        if (!$fileInfo = new \finfo(FILEINFO_MIME_TYPE, $this->magicFile)) {
            return false;
        }

        if (!$mimeType = $fileInfo->file($object->getPathInfo()->getPathName())) {
            return false;
        }

        if (empty($mimeType)) {
            return false;
        }

        if (!$fileInfo = new \finfo(FILEINFO_MIME_ENCODING, $this->magicFile)) {
            return false;
        }

        if (!$mimeEncoding = $fileInfo->file($object->getPathInfo()->getPathName())) {
            return false;
        }

        if (empty($mimeEncoding)) {
            return false;
        }

        return new MimeType($mimeType, $mimeEncoding);
    }
}

/* EOF */
