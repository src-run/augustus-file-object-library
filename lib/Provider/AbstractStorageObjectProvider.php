<?php

/*
 * This file is part of the `src-run/augustus-file-object-library` project.
 *
 * (c) Rob Frawley 2nd <rmf@src.run>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SR\File\Object\Provider;

/**
 * Abstract, base implementation of object provider interface.
 */
abstract class AbstractStorageObjectProvider implements StorageObjectProviderInterface
{
    /**
     * Returns the object identifier.
     *
     * @return mixed
     */
    public function getIdentifier()
    {
        return md5($this->getPathName());
    }

    /**
     * Returns the object URL.
     *
     * @return string
     */
    public function getUrl()
    {
        $pathName = preg_replace('{\\\}', '/', $this->getPathName());

        if (0 === strpos('/', $pathName)) {
            $pathName = '/'.$pathName;
        }

        return urlencode('file://'.$pathName);
    }

    /**
     * Returns the object type as string.
     *
     * @return string
     */
    public function getType()
    {
        if ($this->isFile()) {
            return self::TYPE_FILE;
        } elseif ($this->isDirectory()) {
            return self::TYPE_DIRECTORY;
        }

        return self::TYPE_UNKNOWN;
    }

    public function getMimeTypeGuessers()
    {
        return [
        ];
    }
}

/* EOF */
