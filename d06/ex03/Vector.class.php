<?php

class Vector {

    private $_x;
    private $_y;
    private $_z;
    private $_w = 0;
    static $verbose = false;
    
    public function __construct(array $args) {

        if (isset($args['dest']) && $args['dest'] instanceof Vertex) {
            if (isset($args['orig']) && $args['orig'] instanceof Vertex) {
                    $orig = new Vertex(array('x' => $args['orig']->getX(), 'y' => $args['orig']->getY(), 'z' => $args['orig']->getZ()));
                } else {
                    $orig = new Vertex(array('x' => 0, 'y' => 0, 'z' => 0));
                }
                $this->_x = $args['dest']->getX() - $orig->getX();
                $this->_y = $args['dest']->getY() - $orig->getY();
                $this->_z = $args['dest']->getZ() - $orig->getZ();
                $this->_w = 0;
            }
        if (self::$verbose)
            printf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f ) constructed\n", $this->_x, $this->_y, $this->_z, $this->_w);
    }

    public function __destruct() {
        if (self::$verbose)
            printf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f ) destructed\n", $this->_x, $this->_y, $this->_z, $this->_w);
    }

    public function getX() {
        return $this->_x;
    }

    public function getY() {
        return $this->_y;
    }

    public function getZ() {
        return $this->_z;
    }

    public function getW() {
        return $this->_w;
    }

    public function __toString() {
        return (vsprintf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f )", array($this->_x, $this->_y, $this->_z, $this->_w)));
    }

    static function doc() {
        return file_get_contents('./Vector.doc.txt');
    }
    //simple formula
    public function magnitude() {
        return (float)sqrt(($this->_x * $this->_x) + ($this->_y * $this->_y) + ($this->_z * $this->_z));
    }
    //just get its unitary direction
    public function normalize() {
        $lenofV = $this->magnitude();
        if ($lenofV == 1) {
            return clone $this;
        }
        return new Vector(array('dest' => new Vertex(array('x' => $this->_x / $lenofV, 'y' => $this->_y / $lenofV, 'z' => $this->_z / $lenofV))));
    }

    public function add(Vector $rhs) {
            return new Vector(array('dest' => new Vertex(array('x' => $this->_x + $rhs->_x, 'y' => $this->_y + $rhs->_y, 'z' => $this->_z + $rhs->_z))));
        }

    public function sub(Vector $rhs) {
        return new Vector(array('dest' => new Vertex(array('x' => $this->_x - $rhs->_x, 'y' => $this->_y - $rhs->_y, 'z' => $this->_z - $rhs->_z))));
    }
    // same everything just different direction with -1
    public function opposite() {
        return new Vector(array('dest' => new Vertex(array('x' => $this->_x * -1, 'y' => $this->_y * -1, 'z' => $this->_z * -1))));
    }

    public function scalarProduct($k) {
        return new Vector(array('dest' => new Vertex(array('x' => $this->_x * $k, 'y' => $this->_y * $k, 'z' => $this->_z * $k))));
    }

    public function dotProduct(Vector $rhs) {
        return (float)(($this->_x * $rhs->_x) + ($this->_y * $rhs->_y) + ($this->_z * $rhs->_z));
    }

    public function cos(Vector $rhs) {
       // $magnitudeofRhs = (float)sqrt(($rhs->_x * $rhs->_x) + ($rhs->_y * $rhs->_y) + ($rhs->_z * $rhs->_z));
        return ($this->dotProduct($rhs) / ($rhs->magnitude() * $this->magnitude()));
    }
    
    public function crossProduct(Vector $rhs) {
        return new Vector(array('dest' => new Vertex(array(
            'x' => $this->_y * $rhs->_z - $this->_z * $rhs->_y,
            'y' => $this->_z * $rhs->_x - $this->_x * $rhs->_z,
            'z' => $this->_x * $rhs->_y - $this->_y * $rhs->_x))));
    }

}
?>