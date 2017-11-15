<?php
/**
 * Pop PHP Framework (http://www.popphp.org/)
 *
 * @link       https://github.com/popphp/popphp-framework
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2017 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 */

/**
 * @namespace
 */
namespace Pop\Pdf\Document\Page;

/**
 * Pdf page text class
 *
 * @category   Pop
 * @package    Pop\Pdf
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2017 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 * @version    3.1.0
 */
class Text
{

    /**
     * Text string value
     * @var string
     */
    protected $string = null;

    /**
     * Text strings with offset values
     * @var array
     */
    protected $stringsWithOffsets = [];

    /**
     * Font
     * @var string
     */
    protected $font = null;

    /**
     * Text font size
     * @var int
     */
    protected $size = 12;

    /**
     * Text fill color
     * @var Color\ColorInterface
     */
    protected $fillColor = null;

    /**
     * Text stroke color
     * @var Color\ColorInterface
     */
    protected $strokeColor = null;

    /**
     * Text stroke
     * @var array
     */
    protected $stroke = [
        'width'      => 0,
        'dashLength' => null,
        'dashGap'    => null
    ];

    /**
     * Text wrap
     * @var int
     */
    protected $wrap = 0;

    /**
     * Text line height
     * @var int
     */
    protected $lineHeight = 0;

    /**
     * Text parameters
     * @var array
     */
    protected $textParams = [
        'c'    => 0,
        'w'    => 0,
        'h'    => 100,
        'v'    => 100,
        'rot'  => 0,
        'rend' => 0
    ];

    /**
     * Constructor
     *
     * Instantiate a PDF text object.
     *
     * @param  string $string
     * @param  string $size
     * @param  string $font
     */
    public function __construct($string, $size, $font = null)
    {
        $this->setString($string);
        $this->setSize($size);
        if (null !== $font) {
            $this->setFont($font);
        }
    }

    /**
     * Set the text string
     *
     * @param  string $string
     * @return Text
     */
    public function setString($string)
    {
        if (function_exists('mb_strlen')) {
            if (mb_strlen($string, 'UTF-8') < strlen($string)) {
                $string = utf8_decode($string);
            }
        }
        $this->string = $string;
        return $this;
    }

    /**
     * Add a string with offset
     *
     * @param  string $string
     * @param  int    $offset
     * @return Text
     */
    public function addStringWithOffset($string, $offset = 0)
    {
        if (function_exists('mb_strlen')) {
            if (mb_strlen($string, 'UTF-8') < strlen($string)) {
                $string = utf8_decode($string);
            }
        }
        $this->stringsWithOffsets[] = [
            'string' => $string,
            'offset' => $offset
        ];
        return $this;
    }

    /**
     * Set the text size
     *
     * @param  int|float $size
     * @return Text
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * Set the font
     *
     * @param  string $font
     * @return Text
     */
    public function setFont($font)
    {
        $this->font = $font;
        return $this;
    }

    /**
     * Set the text fill color
     *
     * @param  Color\ColorInterface $color
     * @return Text
     */
    public function setFillColor(Color\ColorInterface $color)
    {
        $this->fillColor = $color;
        return $this;
    }

    /**
     * Set the text stroke color
     *
     * @param  Color\ColorInterface $color
     * @return Text
     */
    public function setStrokeColor(Color\ColorInterface $color)
    {
        $this->strokeColor = $color;
        return $this;
    }

    /**
     * Set the text stroke properties
     *
     * @param  int $width
     * @param  int $dashLength
     * @param  int $dashGap
     * @return Text
     */
    public function setStroke($width, $dashLength = null, $dashGap = null)
    {
        $this->stroke = [
            'width'      => (int)$width,
            'dashLength' => $dashLength,
            'dashGap'    => $dashGap
        ];
        return $this;
    }

    /**
     * Set the word wrap
     *
     * @param  int $wrap
     * @param  int $lineHeight
     * @return Text
     */
    public function setWrap($wrap, $lineHeight = null)
    {
        $this->wrap = (int)$wrap;
        if (null !== $lineHeight) {
            $this->setLineHeight($lineHeight);
        }
        return $this;
    }

    /**
     * Set the word wrap
     *
     * @param  int $lineHeight
     * @return Text
     */
    public function setLineHeight($lineHeight)
    {
        $this->lineHeight = (int)$lineHeight;
        return $this;
    }

    /**
     * Method to set the rotation of the text
     *
     * @param  int $rotation
     * @throws \OutOfRangeException
     * @return Text
     */
    public function setRotation($rotation)
    {
        if (abs($rotation) > 90) {
            throw new \OutOfRangeException('Error: The rotation parameter must be between -90 and 90 degrees.');
        }
        $this->textParams['rot'] = $rotation;
        return $this;
    }

    /**
     * Get the text string
     *
     * @return string
     */
    public function getString()
    {
        return $this->string;
    }

    /**
     * Get the text size
     *
     * @return int|float
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Get the font
     *
     * @return string
     */
    public function getFont()
    {
        return $this->font;
    }

    /**
     * Get the text fill color
     *
     * @return Color\ColorInterface
     */
    public function getFillColor()
    {
        return $this->fillColor;
    }

    /**
     * Get the text stroke color
     *
     * @return Color\ColorInterface
     */
    public function getStrokeColor()
    {
        return $this->strokeColor;
    }

    /**
     * Get the text stroke properties
     *
     * @return array
     */
    public function getStroke()
    {
        return $this->stroke;
    }

    /**
     * Get the word wrap
     *
     * @return int
     */
    public function getWrap()
    {
        return $this->wrap;
    }

    /**
     * Get the line height
     *
     * @return int
     */
    public function getLineHeight()
    {
        return $this->lineHeight;
    }

    /**
     * Get the rotation of the text
     *
     * @return int
     */
    public function getRotation()
    {
        return $this->textParams['rot'];
    }

    /**
     * Set the text parameters for rendering text content
     *
     * @param  int $c    (character spacing)
     * @param  int $w    (word spacing)
     * @param  int $h    (horz stretch)
     * @param  int $v    (vert stretch)
     * @param  int $rot  (rotation, -90 - 90)
     * @param  int $rend (render flag, 0 - 7)
     * @throws \OutOfRangeException
     * @return Text
     */
    public function setTextParams($c = 0, $w = 0, $h = 100, $v = 100, $rot = 0, $rend = 0)
    {
        // Check the rotation parameter.
        if (abs($rot) > 90) {
            throw new \OutOfRangeException('Error: The rotation parameter must be between -90 and 90 degrees.');
        }

        // Check the render parameter.
        if ((!is_int($rend)) || (($rend > 7) || ($rend < 0))) {
            throw new \OutOfRangeException('Error: The render parameter must be an integer between 0 and 7.');
        }

        // Set the text parameters.
        $this->textParams['c']    = $c;
        $this->textParams['w']    = $w;
        $this->textParams['h']    = $h;
        $this->textParams['v']    = $v;
        $this->textParams['rot']  = $rot;
        $this->textParams['rend'] = $rend;

        return $this;
    }

    /**
     * Start the text stream
     *
     * @param  string $fontReference
     * @param  int    $x
     * @param  int    $y
     * @return string
     */
    public function startStream($fontReference, $x, $y)
    {
        $stream        = '';
        $fontReference = substr($fontReference, 0, strpos($fontReference, ' '));

        $stream .= "\nBT\n    {$fontReference} {$this->size} Tf\n    " . $this->calculateTextMatrix() .
            " {$x} {$y} Tm\n    " . $this->textParams['c'] . " Tc " . $this->textParams['w'] .
            " Tw " . $this->textParams['rend'] . " Tr\n";

        return $stream;
    }

    /**
     * Get the partial text stream
     *
     * @param  string $fontReference
     * @return string
     */
    public function getPartialStream($fontReference = null)
    {
        $stream = '';

        if (null !== $fontReference) {
            $fontReference = substr($fontReference, 0, strpos($fontReference, ' '));
            $stream       .= "    {$fontReference} {$this->size} Tf\n";
        }

        if (null !== $this->fillColor) {
            if ($this->fillColor instanceof Color\Rgb) {
                $stream .= '    ' . $this->fillColor . " rg\n";
            } else if ($this->fillColor instanceof Color\Cmyk) {
                $stream .= '    ' . $this->fillColor . " k\n";
            } else if ($this->fillColor instanceof Color\Gray) {
                $stream .= '    ' . $this->fillColor . " g\n";
            }
        }
        if (null !== $this->strokeColor) {
            if ($this->strokeColor instanceof Color\Rgb) {
                $stream .= '    ' . $this->strokeColor . " RG\n";
            } else if ($this->strokeColor instanceof Color\Cmyk) {
                $stream .= '    ' . $this->strokeColor . " K\n";
            } else if ($this->strokeColor instanceof Color\Gray) {
                $stream .= '    ' . $this->strokeColor . " G\n";
            }
        }

        if (count($this->stringsWithOffsets) > 0) {
            $stream .= "    [({$this->string})";
            foreach ($this->stringsWithOffsets as $string) {
                $stream .= " " . (0 - $string['offset']) . " (" . $string['string'] . ")";
            }
            $stream .= "]TJ\n";
        } else {
            if (($this->wrap > 0) && (strlen($this->string) > $this->wrap)) {
                if ((int)$this->lineHeight == 0) {
                    $this->lineHeight = $this->size;
                }
                $strings = explode("\n", wordwrap($this->string, $this->wrap, "\n"));

                foreach ($strings as $i => $string) {
                    $stream .= "    ({$string})Tj\n";
                    if ($i < count($strings)) {
                        $stream .= "    0 -" . $this->lineHeight . " Td\n";
                    }
                }
            } else {
                $stream .= "    ({$this->string})Tj\n";
            }
        }

        return $stream;
    }

    /**
     * End the text stream
     *
     * @return string
     */
    public function endStream()
    {
        return "ET\n";
    }

    /**
     * Get the text stream
     *
     * @param  string $fontReference
     * @param  int    $x
     * @param  int    $y
     * @return string
     */
    public function getStream($fontReference, $x, $y)
    {
        return $this->startStream($fontReference, $x, $y) . $this->getPartialStream() . $this->endStream();
    }

    /**
     * Calculate text matrix
     *
     * @return string
     */
    protected function calculateTextMatrix()
    {
        // Define some variables.
        $a   = '';
        $b   = '';
        $c   = '';
        $d   = '';
        $neg = null;

        // Determine is the rotate parameter is negative or not.
        $neg = ($this->textParams['rot'] < 0) ? true : false;

        // Calculate the text matrix parameters.
        $rot = abs($this->textParams['rot']);

        if (($rot >= 0) && ($rot <= 45)) {
            $factor = round(($rot / 45), 2);
            if ($neg) {
                $a = 1;
                $b = '-' . $factor;
                $c = $factor;
                $d = 1;
            } else {
                $a = 1;
                $b = $factor;
                $c = '-' . $factor;
                $d = 1;
            }
        } else if (($rot > 45) && ($rot <= 90)) {
            $factor = round(((90 - $rot) / 45), 2);
            if ($neg) {
                $a = $factor;
                $b = -1;
                $c = 1;
                $d = $factor;
            } else {
                $a = $factor;
                $b = 1;
                $c = -1;
                $d = $factor;
            }
        }

        // Adjust the text matrix parameters according to the horizontal and vertical scale parameters.
        if ($this->textParams['h'] != 100) {
            $a = round(($a * ($this->textParams['h'] / 100)), 2);
            $b = round(($b * ($this->textParams['h'] / 100)), 2);
        }

        if ($this->textParams['v'] != 100) {
            $c = round(($c * ($this->textParams['v'] / 100)), 2);
            $d = round(($d * ($this->textParams['v'] / 100)), 2);
        }

        // Return the text matrix.
        return "{$a} {$b} {$c} {$d}";
    }

}
