<?php

namespace RegularLabs\Scoped\Intervention\Image;

use RegularLabs\Scoped\Intervention\Image\Exception\NotReadableException;
use RegularLabs\Scoped\Intervention\Image\Exception\NotSupportedException;
abstract class AbstractColor
{
    /**
     * Initiates color object from integer
     *
     * @param  int $value
     * @return \Intervention\Image\AbstractColor
     */
    public abstract function initFromInteger($value);
    /**
     * Initiates color object from given array
     *
     * @param  array $value
     * @return \Intervention\Image\AbstractColor
     */
    public abstract function initFromArray($value);
    /**
     * Initiates color object from given string
     *
     * @param  string $value
     * @return \Intervention\Image\AbstractColor
     */
    public abstract function initFromString($value);
    /**
     * Initiates color object from given ImagickPixel object
     *
     * @param  ImagickPixel $value
     * @return \Intervention\Image\AbstractColor
     */
    public abstract function initFromObject($value);
    /**
     * Initiates color object from given R, G and B values
     *
     * @param  int $r
     * @param  int $g
     * @param  int $b
     * @return \Intervention\Image\AbstractColor
     */
    public abstract function initFromRgb($r, $g, $b);
    /**
     * Initiates color object from given R, G, B and A values
     *
     * @param  int $r
     * @param  int $g
     * @param  int $b
     * @param  float   $a
     * @return \Intervention\Image\AbstractColor
     */
    public abstract function initFromRgba($r, $g, $b, $a);
    /**
     * Calculates integer value of current color instance
     *
     * @return int
     */
    public abstract function getInt();
    /**
     * Calculates hexadecimal value of current color instance
     *
     * @param  string $prefix
     * @return string
     */
    public abstract function getHex($prefix);
    /**
     * Calculates RGB(A) in array format of current color instance
     *
     * @return array
     */
    public abstract function getArray();
    /**
     * Calculates RGBA in string format of current color instance
     *
     * @return string
     */
    public abstract function getRgba();
    /**
     * Determines if current color is different from given color
     *
     * @param  AbstractColor $color
     * @param  int           $tolerance
     * @return boolean
     */
    public abstract function differs(AbstractColor $color, $tolerance = 0);
    /**
     * Creates new instance
     *
     * @param mixed $value
     */
    public function __construct($value = null)
    {
        $this->parse($value);
    }
    /**
     * Parses given value as color
     *
     * @param  mixed $value
     * @return \Intervention\Image\AbstractColor
     */
    public function parse($value)
    {
        switch (\true) {
            case \is_string($value):
                $this->initFromString($value);
                break;
            case \is_int($value):
                $this->initFromInteger($value);
                break;
            case \is_array($value):
                $this->initFromArray($value);
                break;
            case \is_object($value):
                $this->initFromObject($value);
                break;
            case \is_null($value):
                $this->initFromArray([255, 255, 255, 0]);
                break;
            default:
                throw new NotReadableException("Color format ({$value}) cannot be read.");
        }
        return $this;
    }
    /**
     * Formats current color instance into given format
     *
     * @param  string $type
     * @return mixed
     */
    public function format($type)
    {
        switch (\strtolower($type)) {
            case 'rgba':
                return $this->getRgba();
            case 'hex':
                return $this->getHex('#');
            case 'int':
            case 'integer':
                return $this->getInt();
            case 'array':
                return $this->getArray();
            case 'obj':
            case 'object':
                return $this;
            default:
                throw new NotSupportedException("Color format ({$type}) is not supported.");
        }
    }
    /**
     * Reads RGBA values from string into array
     *
     * @param  string $value
     * @return array
     */
    protected function rgbaFromString($value)
    {
        $result = \false;
        // parse color string in hexidecimal format like #cccccc or cccccc or ccc
        $hexPattern = '/^#?([a-f0-9]{1,2})([a-f0-9]{1,2})([a-f0-9]{1,2})$/i';
        // parse color string in format rgb(140, 140, 140)
        $rgbPattern = '/^rgb ?\\(([0-9]{1,3}), ?([0-9]{1,3}), ?([0-9]{1,3})\\)$/i';
        // parse color string in format rgba(255, 0, 0, 0.5)
        $rgbaPattern = '/^rgba ?\\(([0-9]{1,3}), ?([0-9]{1,3}), ?([0-9]{1,3}), ?([0-9.]{1,4})\\)$/i';
        if (\preg_match($hexPattern, $value, $matches)) {
            $result = [];
            $result[0] = \strlen($matches[1]) == '1' ? \hexdec($matches[1] . $matches[1]) : \hexdec($matches[1]);
            $result[1] = \strlen($matches[2]) == '1' ? \hexdec($matches[2] . $matches[2]) : \hexdec($matches[2]);
            $result[2] = \strlen($matches[3]) == '1' ? \hexdec($matches[3] . $matches[3]) : \hexdec($matches[3]);
            $result[3] = 1;
        } elseif (\preg_match($rgbPattern, $value, $matches)) {
            $result = [];
            $result[0] = $matches[1] >= 0 && $matches[1] <= 255 ? \intval($matches[1]) : 0;
            $result[1] = $matches[2] >= 0 && $matches[2] <= 255 ? \intval($matches[2]) : 0;
            $result[2] = $matches[3] >= 0 && $matches[3] <= 255 ? \intval($matches[3]) : 0;
            $result[3] = 1;
        } elseif (\preg_match($rgbaPattern, $value, $matches)) {
            $result = [];
            $result[0] = $matches[1] >= 0 && $matches[1] <= 255 ? \intval($matches[1]) : 0;
            $result[1] = $matches[2] >= 0 && $matches[2] <= 255 ? \intval($matches[2]) : 0;
            $result[2] = $matches[3] >= 0 && $matches[3] <= 255 ? \intval($matches[3]) : 0;
            $result[3] = $matches[4] >= 0 && $matches[4] <= 1 ? $matches[4] : 0;
        } else {
            throw new NotReadableException("Unable to read color ({$value}).");
        }
        return $result;
    }
}