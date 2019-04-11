<?php


class Matrix {
    const IDENTITY = "IDENTITY";
    const SCALE = "SCALE";
    const RX = "Ox ROTATION";
    const RY = "Oy ROTATION";
    const RZ = "Oz ROTATION";
    const TRANSLATION = "TRANSLATION";
    const PROJECTION = "PROJECTION";
    
    protected $matrix = array();
    private $_preset;
    private $_scale;
    private $_angle;
    private $_vtc;
    private $_fov;
    private $_ratio;
    private $_near;
    private $_far;
    static $verbose = false;
    
    public function __construct(array $args=null)
    {
        if (isset($args)) {
            if (isset($args['preset']))
                $this->_preset = $args['preset'];
            if (isset($args['scale']))
                $this->_scale = $args['scale'];
            if (isset($args['angle']))
                $this->_angle = $args['angle'];
            if (isset($args['vtc']))
                $this->_vtc = $args['vtc'];
            if (isset($args['fov']))
                $this->_fov = $args['fov'];
            if (isset($args['ratio']))
                $this->_ratio = $args['ratio'];
            if (isset($args['near']))
                $this->_near = $args['near'];
            if (isset($args['far']))
                $this->_far = $args['far'];
            $this->mandatoryRelations();
            $this->createMatrix();
            if (self::$verbose) {
                if ($this->_preset == self::IDENTITY)
                    echo "Matrix " . $this->_preset . " instance constructed\n";
                else
                    echo "Matrix " . $this->_preset . " preset instance constructed\n";
            }
            if ($this->_preset == self::IDENTITY)
                $this->identity(1);
            else if ($this->_preset == self::TRANSLATION)
                $this->translation();
            else if ($this->_preset == self::PROJECTION)
                $this->projection();
            else if ($this->_preset == self::SCALE)
                $this->identity(1);
            else if ($this->_preset == self::RX)
                $this->rotation_x();
            else if ($this->_preset == self::RY)
                $this->rotation_y();
            else if ($this->_preset == self::RX)
                $this->rotation_x();
            else if ($this->_preset == self::RZ)
                $this->rotation_z();
        }
    }

    function __destruct() {
        if (self::$verbose)
            echo "Matrix instance destructed\n";
    }

    public static function doc() {
        echo file_get_contents('./Matrix.doc.txt');
    }

    function __toString()
    {
        $format = "M | vtcX | vtcY | vtcZ | vtxO\n-----------------------------\nx | %0.2f | %0.2f | %0.2f | %0.2f\ny | %0.2f | %0.2f | %0.2f | %0.2f\nz | %0.2f | %0.2f | %0.2f | %0.2f\nw | %0.2f | %0.2f | %0.2f | %0.2f";
        return (vsprintf($format, array($this->matrix[0], $this->matrix[1], $this->matrix[2], $this->matrix[3], $this->matrix[4], $this->matrix[5], $this->matrix[6], $this->matrix[7], $this->matrix[8], $this->matrix[9], $this->matrix[10], $this->matrix[11], $this->matrix[12], $this->matrix[13], $this->matrix[14], $this->matrix[15])));
    }

    private function mandatoryRelations() {
        if (empty($this->_preset))
            return "error";
        if ($this->_preset == self::SCALE && empty($this->_scale))
            return "error";
        if (($this->_preset == self::RX || $this->_preset == self::RY || $this->_preset == self::RZ) && empty($this->_angle))
            return "error";
        if ($this->_preset == self::TRANSLATION && empty($this->_vtc))
            return "error";
        if ($this->_preset == self::PROJECTION && (empty($this->_fov) || empty($this->_radio) || empty($this->_near) || empty($this->_far)))
            return "error";
    }

    private function createMatrix() {
        $i = 0;
        while ($i < 16) {
            $this->matrix[$i] = 0;
            $i++;
        }
    }
    //just add the scale in the right places
    private function identity($scale) {
        $this->matrix[0] = $scale;
        $this->matrix[5] = $scale;
        $this->matrix[10] = $scale;
        $this->matrix[15] = 1;
    }
    
    private function translation() {
        $this->identity(1);
        $this->matrix[3] = $this->_vtc->getX();
        $this->matrix[7] = $this->_vtc->getY();
        $this->matrix[11] = $this->_vtc->getZ();
    }

    public function mult(Matrix $rhs) {
        $holder = array();
        for ($i = 0; $i < 16; $i += 4) {
            for ($j = 0; $j < 4; $j++) {
                $holder[$i + $j] = 0;
                $holder[$i + $j] += $this->matrix[$i + 0] * $rhs->matrix[$j + 0];
                $holder[$i + $j] += $this->matrix[$i + 1] * $rhs->matrix[$j + 4];
                $holder[$i + $j] += $this->matrix[$i + 2] * $rhs->matrix[$j + 8];
                $holder[$i + $j] += $this->matrix[$i + 3] * $rhs->matrix[$j + 12];
            }
        }
        $new_matrix = new Matrix();
        $new_matrix->matrix = $holder;
        return $new_matrix;
    }
    //formulas https://en.wikipedia.org/wiki/Rotation_matrix 
    private function rotation_x() {
        $this->identity(1);
        $this->matrix[0] = 1;
        $this->matrix[5] = cos($this->_angle);
        $this->matrix[6] = -sin($this->_angle);
        $this->matrix[9] = sin($this->_angle);
        $this->matrix[10] = cos($this->_angle);
    }
    private function rotation_y() {
        $this->identity(1);
        $this->matrix[0] = cos($this->_angle);
        $this->matrix[2] = sin($this->_angle);
        $this->matrix[5] = 1;
        $this->matrix[8] = -sin($this->_angle);
        $this->matrix[10] = cos($this->_angle);
    }
    private function rotation_z() {
        $this->identity(1);
        $this->matrix[0] = cos($this->_angle);
        $this->matrix[1] = -sin($this->_angle);
        $this->matrix[4] = sin($this->_angle);
        $this->matrix[5] = cos($this->_angle);
        $this->matrix[10] = 1;
    }
    //use this https://gamedev.stackexchange.com/questions/28249/calculate-new-vertex-position-given-a-transform-matrix
    public function transformVertex(Vertex $vtx) {
        $holder = array();
        $holder['x'] = ($vtx->getX() * $this->matrix[0]) + ($vtx->getY() * $this->matrix[1]) + 
             ($vtx->getZ() * $this->matrix[2]) +
             ($vtx->getW() * $this->matrix[3]);
        $holder['y'] = ($vtx->getX() * $this->matrix[4]) +
             ($vtx->getY() * $this->matrix[5]) +
             ($vtx->getZ() * $this->matrix[6]) +
             ($vtx->getW() * $this->matrix[7]);
        $holder['z'] = ($vtx->getX() * $this->matrix[8]) +
            ($vtx->getY() * $this->matrix[9]) +
            ($vtx->getZ() * $this->matrix[10]) +
            ($vtx->getW() * $this->matrix[11]);
        $holder['w'] = ($vtx->getX() * $this->matrix[11]) +
            ($vtx->getY() * $this->matrix[13]) +
            ($vtx->getZ() * $this->matrix[14]) +
            ($vtx->getW() * $this->matrix[15]);
        $holder['color'] = $vtx->getColor();
        $vertex = new Vertex($holder);
        return $vertex;
    }
    //more formulas
    private function projection() {
        $this->identity(1);
            $this->matrix[5] = 1 / tan(0.5 * deg2rad($this->_fov));
            $this->matrix[0] = $this->matrix[5] / $this->_ratio;
            $this->matrix[10] = -1 * (-$this->_near - $this->_far) / ($this->_near - $this->_far);
            $this->matrix[14] = -1;
            $this->matrix[11] = (2 * $this->_near * $this->_far) / ($this->_near - $this->_far);
            $this->matrix[15] = 0;
    }   
}