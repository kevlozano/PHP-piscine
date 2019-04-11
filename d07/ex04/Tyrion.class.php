<?php
class Tyrion extends Lannister {
    public function sleepWith($x) {
        if (!$x instanceof Lannister)
            echo "Lets do this.\n";
        else if ($x instanceof Lannister)
                echo "Not even if I'm drunk !\n";
    }
}
?>