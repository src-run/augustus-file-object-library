<?php

/*
 * This file is part of the `src-run/augustus-file-object-library` project.
 *
 * (c) Rob Frawley 2nd <rmf@src.run>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SR\File\Object\Guesser\Model;

/**
 * Mime type value object containing mime type, mime charset, and mime determined extension.
 */
class MimeType
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $encoding;

    /**
     * @var string[]
     */
    private $extensions;

    /**
     * Onject construction requires only the mime type, but can optionally include the encoding and extension(s).
     *
     * @param string   $type
     * @param string   $encoding
     * @param string[] $extensions
     */
    public function construct($type, $encoding = null, array $extensions = [])
    {
        $this->type = $type;
        $this->encoding = $encoding;
        $this->extensions = $extensions;
    }

    /**
     * Returns the encoding type.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getType();
    }

    /**
     * Returns the mime type string.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Determine if an encoding has been assigned.
     *
     * @return bool
     */
    public function hasEncoding()
    {
        return $this->encoding !== null;
    }

    /**
     * Returns the encoding string.
     *
     * @return string
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * Determined if any extensions have been assigned.
     *
     * @return bool
     */
    public function hasExtensions()
    {
        return count($this->extensions) !== 0;
    }

    /**
     * Returns all resolved extensions.
     *
     * @return string[]
     */
    public function getExtensions()
    {
        return $this->extensions;
    }

    /**
     * Returns first (highest-priority) extension string.
     *
     * @return null|string
     */
    public function getExtensionLikely()
    {
        return $this->hasExtensions() ? $this->extensions[0] : null;
    }
}

/* EOF */
