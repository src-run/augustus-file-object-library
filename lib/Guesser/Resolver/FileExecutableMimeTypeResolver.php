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
use Symfony\Component\Process\ProcessBuilder;

/**
 * Mime type resolver using file system executable.
 */
class FileExecutableMimeTypeResolver implements MimeTypeResolverInterface
{
    const EXECUTABLE = 'file';

    /**
     * Determine if resolver is supported and supports object.
     *
     * @param null|StorageObjectInterface $object
     *
     * @return bool
     */
    public function supports(StorageObjectInterface $object = null)
    {
        return class_exists('Symfony\Component\Process\Process') && $object->getContext()->isLocal();
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

        $process = ProcessBuilder::create([
            self::EXECUTABLE,
            '-E',
            '--brief',
            '--mime-type',
            $object->getPathInfo()->getPathName(),
        ])->getProcess();

        $process->run();

        if ($process->getExitCode() !== 0 || empty($process->getOutput())) {
            return false;
        }

        $mimeType = $process->getOutput();

        $process = ProcessBuilder::create([
            self::EXECUTABLE,
            '-E',
            '--brief',
            '--mime-encoding',
            $object->getPathInfo()->getPathName(),
        ])->getProcess();

        $process->run();

        if ($process->getExitCode() !== 0 || empty($process->getOutput())) {
            return false;
        }

        $mimeEncoding = $process->getOutput();

        return new MimeType($mimeType, $mimeEncoding);
    }
}

/* EOF */
