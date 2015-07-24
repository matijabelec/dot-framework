<?php

class Story_view extends View {
    public function show_story() {
        if($this->model) {
            echo '<h1>' . $this->model->title . '</h1>';
            echo '<p>' . $this->model->desc . '</p>';
        }
    }
}

?>