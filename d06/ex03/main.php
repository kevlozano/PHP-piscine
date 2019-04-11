<?php
require 'Vertex.class.php';
require 'Vector.class.php';
require 'Matrix.class.php';

$vtx = new Vertex( array( 'x' => 20.0, 'y' => 20.0, 'z' => 0.0 ) );
print($vtx);
echo "\n";
$vtc = new Vector( array( 'dest' => $vtx ) );
print($vtc);
?>
