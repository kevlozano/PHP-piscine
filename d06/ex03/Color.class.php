<?php

class Color {

    public $red = 0;
    public $green = 0;
    public $blue = 0;
    static $verbose = false;

    function __construct(array $args) {
        //algorithm found in math.stackexchange
        if (isset($args['rgb'])) {
			$this->red = $args['rgb']>>16;
			$this->green = $args['rgb']>>8&255;
			$this->blue = $args['rgb']&255;
		}
		else if (isset($args['red']) && isset($args['green']) && isset($args['blue'])) {
			$this->red = intval($args['red'], 10);
			$this->green = intval($args['green'], 10);
            $this->blue = intval($args['blue'], 10);
		}
        if (self::$verbose === true)
            printf("Color(red: %3d, green: %3d, blue: %3d) constructed.\n", $this->red, $this->green, $this->blue);
    }

    function __destruct() {
        if (self::$verbose)
                printf("Color( red: %3d, green: %3d, blue: %3d ) destructed.\n", $this->red, $this->green, $this->blue);
    }

    function __toString() {
        return (vsprintf("Color(red: %3d, green: %3d, blue: %3d)", array($this->red, $this->green, $this->blue)));
    }

    static function doc() {
        echo file_get_contents("./Color.doc.txt")."\n";
    }

    function add(Color $Color) {
        return new Color(array( 'red' => $Color->red + $this->red, 'green' => $Color->green + $this->green, 'blue' => $Color->blue + $this->blue ));
    }

    function sub(Color $Color) {
        return new Color(array( 'red' => $this->red - $Color->red, 'green' => $this->green - $Color->green, 'blue' => $this->blue - $Color->blue));
    }

    function mult($times) {
        return new Color(array( 'red' => $times * $this->red, 'green' => $times * $this->green, 'blue' => $times * $this->blue ));
    }
}
?>