<?php

class Story_view extends View {
    public function show_story() {
        if($this->model) {
            return '
<div>
    <h1>' . $this->model->title . '</h1>
    <p>' . $this->model->desc . '</p>
    <hr/>
</div>';
        }
    }
}

?>