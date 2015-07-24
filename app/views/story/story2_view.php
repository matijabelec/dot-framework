<?php

class Story2_view extends View {
    public function show_story() {
        if($this->model) {
            echo '<div style="border: 1px solid #000">';
            echo '<h2>' . $this->model->title . '</h2>';
            echo '<hr/>';
            echo '<p>' . $this->model->desc . '</p>';
            echo '</div>';
        }
    }
}

?>