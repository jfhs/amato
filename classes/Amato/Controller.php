<?php

class Amato_Controller extends Kohana_Controller {

    public function before() {
        parent::before();
        I18n::$lang = Session::instance()->get('language', I18n::$lang);
    }

    public function json($data) {
        $this->response->body(json_encode($data));
    }
}