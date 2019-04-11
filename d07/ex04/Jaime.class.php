<?php
class Jaime extends Lannister {
    public function sleepWith($x) {
        if (!$x instanceof Lannister)
            echo "Lets do this.\n";
        else {
            if ($x instanceof Tyrion)
                echo "Not even if I'm drunk !\n";
            else
                echo "With pleasure, but only in a tower in Winterfell, then.\n";
        
        }
    }
}
?>