<?php

class Amato_Controller_Model extends Controller_Template
{
	protected $_model;
	protected $_pagination = true;
	protected $_per_page = 10;

	protected function get_view($name)
	{
		return View::factory($this->_model.'/'.$name);
	}

	public function action_view()
	{
		$id = $this->request->param('id');
		$o = ORM::factory($this->_model, $id);
		if (!$o->loaded())
		{
			throw new HTTP_Exception_404();
		}
		$view = $this->get_view('view');
		$view->bind('item', $o);
		$this->template->content = $view;
	}

	protected function get_list()
	{
		return ORM::factory($this->_model);
	}

	public function action_list()
	{
		$page = $this->request->query('page');
		if (!$page) {
			$page = 1;
		}
		$list = $this->get_list()->reset(false);
		$count = $list->count_all();
		$pages = ceil($count/$this->_per_page);
		$view = $this->get_view('list');
		$view->set(array(
			'items' => $list->offset(($page-1)*$this->_per_page)->limit($this->_per_page)->find_all(),
			'page' => $page,
			'pages' => $pages,
		));
		$this->template->content = $view;
	}
}