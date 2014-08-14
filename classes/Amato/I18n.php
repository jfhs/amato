<?php

class Amato_I18n extends Kohana_I18n {

    public static $ban = array();

    public static function get($text, $id = null, $lang = null) {
        if ($lang == null) {
            $lang = self::lang();
        }

        //handle ORM case
        if ($text instanceof ORM) {
            $name = $id.'_'.$lang;
            return $text->$name;
        }

        //that's right, there is no id arg in normal i18n...
        return parent::get($text, $id);
    }

	public static function month($id, $form = 0) {
		$months = array(
			array('январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь'),
			array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'),
		);
		return $months[$form][(int)$id];
	}
}