<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Mvenghaus\Magento2WidgetDirective\Tokenizer;

/**
 * Template constructions tokenizer
 */
abstract class AbstractTokenizer
{
    /**
     * Current index in string
     *
     * @var int
     */
    protected $_currentIndex;

    /**
     * String for tokenize
     *
     * @var string
     */
    protected $_string;

    /**
     * Move current index to next char.
     *
     * If index out of bounds returns false
     *
     * @return boolean
     */
    public function next()
    {
        $stringLength = $this->_string !== null ? strlen($this->_string) : 0;
        if ($this->_currentIndex + 1 >= $stringLength) {
            return false;
        }

        $this->_currentIndex++;
        return true;
    }

    /**
     * Move current index to previous char.
     *
     * If index out of bounds returns false
     *
     * @return boolean
     */
    public function prev()
    {
        if ($this->_currentIndex - 1 < 0) {
            return false;
        }

        $this->_currentIndex--;
        return true;
    }

    /**
     * Move current index backwards.
     *
     * If index out of bounds returns false
     *
     * @param int $distance number of characters to backtrack
     * @return bool
     */
    public function back($distance)
    {
        if ($this->_currentIndex - $distance < 0) {
            return false;
        }

        $this->_currentIndex -= $distance;
        return true;
    }

    /**
     * Return current char
     *
     * @return string
     */
    public function char()
    {
        return $this->_string[$this->_currentIndex];
    }

    /**
     * Set string for tokenize
     *
     * @param string $value
     * @return void
     */
    public function setString($value)
    {
        $this->_string = rawurldecode($value);
        $this->reset();
    }

    /**
     * Move char index to begin of string
     *
     * @return void
     */
    public function reset()
    {
        $this->_currentIndex = 0;
    }

    /**
     * Return true if current char is white-space
     *
     * @return boolean
     */
    public function isWhiteSpace()
    {
        return $this->_string === '' ?: trim((string)$this->char()) !== $this->char();
    }

    /**
     * Tokenize string
     *
     * @return array
     */
    abstract public function tokenize();
}
