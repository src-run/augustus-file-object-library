<?php

/*
 * This file is part of the `src-run/augustus-file-object-library` project.
 *
 * (c) Rob Frawley 2nd <rmf@src.run>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SR\File\Object\Guesser\Decider;

use SR\File\Object\Exception\MetadataException;
use SR\File\Object\Exception\NotAccessibleException;
use SR\File\Object\Exception\NotReadableException;
use SR\File\Object\Guesser\Model\MimeType;
use SR\File\Object\Guesser\Resolver\MimeTypeResolverInterface;
use SR\File\Object\StorageObjectInterface;

/**
 * Proxy mime type guesser that attempts to determine mime type using multiple implementations.
 */
class MimeTypeDecider implements MimeTypeResolverInterface
{
    /**
     * @var MimeTypeResolverInterface[]
     */
    private $resolvers = [];

    /**
     * Register mime type guesser implementation.
     *
     * @param MimeTypeResolverInterface $resolver
     * @param int|null                  $priority
     *
     * @return bool
     */
    public function register(MimeTypeResolverInterface $resolver, int $priority = null)
    {
        if (null === $priority) {
            return array_unshift($this->resolvers, $resolver);
        }

        $this->resolvers[$priority] = $resolver;

        return true;
    }

    /**
     * Determine if resolver is supported and supports object.
     *
     * @param StorageObjectInterface $object
     *
     * @return bool
     */
    public function supports(StorageObjectInterface $object = null)
    {
        $failures = 0;

        foreach ($this->resolvers as $resolver) {
            if (!$resolver->supports($object)) {
                ++$failures;
            }
        }

        return count($this->resolvers) > $failures;
    }

    /**
     * Attempt to determine the mime type of the file object.
     *
     * @param StorageObjectInterface $object
     *
     * @throws MetadataException      If mime type could not be guessed
     * @throws NotAccessibleException If the file object is not accessible
     * @throws NotReadableException   If the file object is not readable
     *
     * @return bool|MimeType
     */
    public function resolve(StorageObjectInterface $object)
    {
        if (!$object->exists()) {
            throw new NotAccessibleException(
                'Could not guess mime type on non-existent file "%s"',
                $object->getPathInfo()->getPathName()
            );
        }

        if (!$object->getPermissions()->isReadable()) {
            throw new NotReadableException(
                'Could not guess mime type on unreadable file "%s"',
                $object->getPathInfo()->getPathName()
            );
        }

        foreach ($this->resolvers as $resolver) {
            if (!$resolver->supports($object)) {
                continue;
            }

            if (false === $mimeType = $this->attemptResolution($resolver, $object)) {
                continue;
            }

            if ($mimeType instanceof MimeType) {
                return $mimeType;
            }
        }

        throw new MetadataException(
            'Could not determine mime type "%s" after exhausting resolvers',
            $object->getPathInfo()->getPathName()
        );
    }

    /**
     * @param MimeTypeResolverInterface $resolver
     * @param StorageObjectInterface    $object
     *
     * @return MimeType|bool
     */
    private function attemptResolution(MimeTypeResolverInterface $resolver, StorageObjectInterface $object)
    {
        return $resolver->resolve($object);
    }
}

/* EOF */
