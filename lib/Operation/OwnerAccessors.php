<?php

/*
 * This file is part of the `src-run/augustus-file-object-library` project.
 *
 * (c) Rob Frawley 2nd <rmf@src.run>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SR\File\Object\Operation;

use SR\File\Object\Exception\MetadataException;

/**
 * Provides owner info for object for {@see StorageObjectProviderInterface}.
 */
class OwnerAccessors extends AbstractAccessors
{
    /**
     * Returns the storage object uid.
     *
     * @return mixed
     */
    public function getUserIdentifier()
    {
        return $this->provider->getOwningUser();
    }

    /**
     * Returns the storage object owner's user name.
     *
     * @throws MetadataException
     *
     * @return string
     */
    public function getUserName()
    {
        if (!$this->hasPosixExtension()) {
            throw new MetadataException('Could not get user name for "%s" without posix ext', $this->getUserIdentifier());
        }

        return $this->getUserNameUseExtensionPosix();
    }

    /**
     * Returns the storage object gid.
     *
     * @return mixed
     */
    public function getGroupIdentifier()
    {
        return $this->provider->getOwningGroup();
    }

    /**
     * Returns the storage object owner's group name.
     *
     * @throws MetadataException
     *
     * @return string
     */
    public function getGroupName()
    {
        if (!$this->hasPosixExtension()) {
            throw new MetadataException('Could not get group name for "%s" without posix ext', $this->getGroupIdentifier());
        }

        return $this->getGroupNameUseExtensionPosix();
    }

    /**
     * Returns if posix extension is available.
     *
     * @return bool
     */
    public function hasPosixExtension()
    {
        return function_exists('posix_getpwuid') && function_exists('posix_getgrgid');
    }

    /**
     * @return false|string
     */
    private function getUserNameUseExtensionPosix()
    {
        $info = posix_getpwuid($this->getUserIdentifier());

        return isset($info['name']) ? $info['name'] : false;
    }

    /**
     * @return false|string
     */
    private function getGroupNameUseExtensionPosix()
    {
        $info = posix_getgrgid($this->getGroupIdentifier());

        return isset($info['name']) ? $info['name'] : false;
    }
}

/* EOF */
