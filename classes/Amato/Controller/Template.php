<?php

class Amato_Controller_Template extends Kohana_Controller_Template {

    public function json($data) {
        $this->auto_render = false;
        parent::json($data);
    }
}