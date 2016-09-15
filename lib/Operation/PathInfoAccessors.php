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

use SR\File\Object\Exception\NotFoundException;

/**
 * Provides path info methods for {@see StorageObjectProviderInstance}.
 */
class PathInfoAccessors extends AbstractAccessors
{
    /**
     * Returns an object full path name.
     *
     * @param bool $resolve Tries to resolve the real path if true.
     *
     * @throws NotFoundException If real path resolution fails.
     *
     * @return string
     */
    public function getFile($resolve = false)
    {
        return $this->getPathName($resolve);
    }

    /**
     * Returns an object file name.
     *
     * @param bool $resolve Tries to resolve the real path if true.
     *
     * @throws NotFoundException If real path resolution fails.
     *
     * @return string
     */
    public function getFileName($resolve = false)
    {
        return pathinfo($this->getPathName($resolve), PATHINFO_FILENAME);
    }

    /**
     * Returns an object base name.
     *
     * @param null|string $suffix  A suffix to remove from the base name.
     * @param bool        $resolve Tries to resolve the real path if true.
     *
     * @throws NotFoundException If real path resolution fails.
     *
     * @return mixed
     */
    public function getBaseName($suffix = null, $resolve = false)
    {
        if (0 !== strpos($suffix, '.')) {
            $suffix = '.'.$suffix;
        }

        return basename(pathinfo($this->getPathName($resolve), PATHINFO_BASENAME), $suffix);
    }

    /**
     * Returns an object path.
     *
     * @param bool $resolve Tries to resolve the real path if true.
     *
     * @throws NotFoundException If real path resolution fails.
     *
     * @return string
     */
    public function getPath($resolve = false)
    {
        return pathinfo($this->getPathName($resolve), PATHINFO_DIRNAME);
    }

    /**
     * Returns the object's full path name.
     *
     * @param bool $resolve Tries to resolve the real path if true.
     *
     * @throws NotFoundException If real path resolution fails.
     *
     * @return string
     */
    public function getExtension($resolve = false)
    {
        return pathinfo($this->getPathName($resolve), PATHINFO_EXTENSION);
    }

    /**
     * Returns an object full path name.
     *
     * @param bool $resolve Tries to resolve the real path if true.
     *
     * @throws NotFoundException If real path resolution fails.
     *
     * @return string
     */
    public function getPathName($resolve = false)
    {
        return $resolve ? $this->getRealPathName() : $this->provider->getPathName();
    }

    /**
     * @throws NotFoundException If real path resolution fails.
     *
     * @return string
     */
    private function getRealPathName()
    {
        if (false === $realPath = $this->provider->getRealPathName()) {
            throw new NotFoundException('Could not resolve real path for "%s"', $this->getPathName());
        }

        return $realPath;
    }
}

/* EOF */
