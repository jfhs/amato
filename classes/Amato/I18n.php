<?php

class Amato_I18n extends Kohana_I18n {

    public static function getLang() {
        if (self::$lang == null) {
            self::$lang = Session::instance()->get('language', self::$lang);
        }
        return self::$lang;
    }

    public static function setLang($lang) {
        self::$lang = $lang;
    }

    public static $ban = array();

    public static function get($text, $id = null, $type = 'text', $lang = null) {
        if ($lang == null) {
            $lang = self::getLang();
        }
        if ($id == null) {
            $id = md5($text);
        }
        //TODO: fix hardcode
        $tr = ORM::factory('Literal')->where('id', '=', $id)->where('lang', '=', $lang)->find();
        if ($tr->loaded()) {
            $translation = $tr->translation;
        } else {
            $translation = $text;
        }
        if (!$tr->loaded() && ($lang != 'ru')) {
            if (!in_array($id, self::$ban)) {
                $tr->text = $text;
                $tr->translation = $text;
                $tr->lang = $lang;
                $tr->id = $id;
                $tr->type = $type;
                $tr->save();
            }
        }
        return $translation;
    }

	public static function month($id, $form = 0) {
		$months = array(
			array('январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь'),
			array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'),
		);
		return $months[$form][(int)$id];
	}
}