<?php

class UnholyFactory {

    private $_soldiers = [];
    private $_objs = [];
    
    public function absorb($kind) {
        if ($kind instanceof Fighter) {
            if (in_array($kind->type, $this->_soldiers)) {
                echo "(Factory already absorbed a fighter of type ".$kind->type.")\n";
            }
            else {
                $this->_soldiers[] = $kind->type;
                $this->_objs[] = new $kind;
                echo "(Factory absorbed a fighter of type ".$kind->type.")\n";
            }
        }
        else
            echo "(Factory can't absorb this, it's not a fighter)\n";
    }
    
    public function fabricate($rf) {
        if (in_array($rf, $this->_soldiers)) {
            $key = array_search($rf, $this->_soldiers);
            echo "(Factory fabricates a fighter of type ".$rf.")\n";
            
            return clone $this->_objs[$key];
            
        }
        else
            echo "(Factory hasn't absorbed any fighter of type ".$rf.")\n";
    }
}
?>