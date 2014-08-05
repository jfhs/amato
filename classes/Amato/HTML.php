<?php

class Amato_HTML extends Kohana_HTML {


	public static function image($file, array $attributes = NULL, $protocol = NULL, $index = FALSE)
	{
		if (isset($attributes['width']) && isset($attributes['height'])) {
			$file = str_replace(Upload::$default_directory.'/', Upload::$default_directory.'/'.$attributes['width'].'x'.$attributes['height'].'/', $file);
			$file = str_replace('`', '__accent__', $file);
		}
		return parent::image($file, $attributes, $protocol, $index);
	}

	public static function image_url($file, $width, $height, $protocol = NULL, $index = TRUE)
	{
		$file = str_replace(Upload::$default_directory.'/', Upload::$default_directory.'/'.$width.'x'.$height.'/', $file);
		$file = str_replace('`', '__accent__', $file);
		return URL::site($file, $protocol, $index);
	}
}