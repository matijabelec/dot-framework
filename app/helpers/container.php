<?php

class Container implements iRenderable {
    private $items;
    
    public function add(iRenderable $item) {
        $this->items[] = $item;
    }
    
    public function render() {
        $output = '';
        if(isset($this->items) && is_array($this->items) )
            foreach($this->items as $item)
                $output .= $item->render();
        return $output;
    }
}

?>