<?php
require_once 'Vertex.class.php';
require_once 'Vector.class.php';
require_once 'Matrix.class.php';


Vertex::$verbose = False;
Vector::$verbose = False;

Matrix::$verbose = True;

print( 'So far, so good. Let\'s create a translation matrix now.' . PHP_EOL );
$vtx = new Vertex( array( 'x' => 20.0, 'y' => 20.0, 'z' => 0.0 ) );
echo $vtx."\n";
$vtc = new Vector( array( 'dest' => $vtx ) );
echo $vtc."\n";
$T  = new Matrix( array( 'preset' => Matrix::TRANSLATION, 'vtc' => $vtc ) );
print( $T . PHP_EOL . PHP_EOL );
?>
