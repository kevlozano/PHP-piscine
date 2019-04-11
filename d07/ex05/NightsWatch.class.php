<?php
    class NightsWatch {

        public $recruits = [];
        public function recruit($x) {
            $this->recruits[] = $x;
        }
        public function fight() {
            foreach ($this->recruits as $x) {
                if ($x instanceof IFighter) {
                    $x->fight();
                }
            }
        }
    }
?>