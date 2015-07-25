<?php

class Story_mini_view extends View {
    public function show_story() {
        if($this->model) {
            return '
<div style="border: 1px solid #000">
    <h2>' . $this->model->title . '</h2>
    <p>' . $this->model->desc . '</p>
</div>';
        }
    }
}

?>