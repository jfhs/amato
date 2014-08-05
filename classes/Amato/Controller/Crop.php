<?php

class Amato_Controller_Crop extends Controller {

	public function action_index() {
		$w = $this->request->param('w');
		$h = $this->request->param('h');
		$image = $this->request->param('i');
		$image = str_replace('__accent__', '`', $image);
		$img = Image::factory('upload/'.$image);
		$img->resize($w, $h, Image::INVERSE);
		$img->crop($w, $h);
		$dir = 'upload/'.$w.'x'.$h;
		if (!file_exists($dir)) {
			mkdir($dir);
		}
		file_put_contents($dir.'/'.basename($image), $img->render());
		$this->response->body($img->render());
	}
}