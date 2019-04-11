<?php

    abstract class Fighter {

        public $type;
        
        public function __construct($kind) {
            $this->type = $kind;
        }
        abstract function fight($target);
    }
?>