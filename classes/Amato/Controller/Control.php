<?php defined('SYSPATH') or die('No direct script access.');

class Amato_Controller_Control extends Controller_Template {

    public $template = 'control';
    protected $user;
	protected $login;
	protected $password;
    /**
     * @var Session
     */
    protected $session;
    protected static $menu = array();

	public static function set_menu_item($key, $item)
	{
		static::$menu[$key] = $item;
	}

    public function before() {
        parent::before();
        $this->session = Session::instance();
        $logged_on = $this->session->get('logged_on') == 1;
        $action = $this->request->action();
        if (($action != 'login') && (!$logged_on)) {
            $this->session->set('redirect', $this->request->url());
            $this->redirect('control/login');
        }
        if ($action != 'login') {
            $this->template->active_menu = $action;
            $this->template->bind('menu', static::$menu);
            $this->template->messages = array();
        }
    }

	protected function check_auth($login, $password) {
		return ($this->login === $login) && ($this->password === $password);
	}

    public function action_login() {
        $view_data = array(
            'failed' => false,
            'login' => '',
        );
        if ($this->request->method() == 'POST') {
            $login = $this->request->post('login');
            $password = $this->request->post('password');
            if ($this->check_auth($login, $password)) {
                $_SESSION['authorized'] = true;
                $this->session->set('logged_on', 1);
                $this->session->write();
                $this->redirect('control');
            }
            $view_data['failed'] = true;
            $view_data['login'] = $login;
        }
        $this->template = View::factory('control/login', $view_data);
    }

    public function action_logout() {
        $this->session->delete('logged_on');
        $this->session->write();
        $this->redirect('');
    }

    protected static function recursive_update_fields(ORM $model, $fields, $files = null) {
        if (!is_array($fields)) {
            return;
        }
        $cols = $model->table_columns();
        $has_many = $model->has_many();
        $has_one = $model->has_one();
        $belongs_to = $model->belongs_to();
        $related_objects = array();
        $delayed_objects = array();
        foreach($fields as $field=>$value) {
            /*if (!isset($cols[$field]) && !isset($has_many[$field]) && !isset($has_one[$field]) && !isset($belongs_to[$field]))  {
                continue;
            }*/
            if (is_array($value)) {
                $model_name = $model->$field->object_name();
                foreach($value as $id=>$ifields) {

					//for simple linking
					if (!is_array($ifields)) {
						$o = ORM::factory($model_name, $ifields);
						if ($o->loaded() && !$model->has($field, $ifields)) {
							$related_objects[$field][] = $o;
						}
						continue;
					}

                    if ($id <= 0) {
                        $id = null;
                    }
                    $m = ORM::factory($model_name, $id);
                    if ($id == null) {
                        if (isset($has_many[$field]['pivot_table'])) {
                            $related_objects[$field][] = $m;
                        } else {
                            $delayed_objects[$field][] = $ifields;
                            continue;
                        }
                    }
                    self::recursive_update_fields($m, $ifields);
                }
            } else {
                $model->$field = $value;
            }
        }
        $model->save();
        foreach($related_objects as $field=>$a) {
            foreach($a as $o) {
                $model->add($field, $o);
            }
        }
        foreach($delayed_objects as $field=>$a) {
            foreach($a as $o) {
                $m = ORM::factory($model->$field->object_name());
                if (!isset($has_many[$field]['foreign_key'])) {
                    $foreign_key = lcfirst($has_many[$field]['model']).'_id';
                } else {
                    $foreign_key = $has_many[$field]['foreign_key'];
                }
                $m->$foreign_key = $model->id;
                self::recursive_update_fields($m, $o);
            }
        }
    }

    private static function recursive_convert_files(&$data, $files, $key) {
        foreach($files as $k=>$v) {
            if (!isset($data[$k])) {
                $data[$k] = array();
            }
            if (is_array($v)) {
                self::recursive_convert_files($data[$k], $v, $key);
            } else {
                $data[$k][$key] = $v;
            }
        }
    }

    private static function recursive_upload_files(&$fields, $files) {
        foreach($files as $key=>$file) {
            if (isset($file['name']) && !is_array($file['name'])) {
                if (Upload::valid($file) && Upload::not_empty($file)) {
                    //booo, scary!
						$fields[$key] = Upload::$default_directory.'/'.str_replace(DIRECTORY_SEPARATOR, '/', str_replace(realpath(Upload::$default_directory).DIRECTORY_SEPARATOR, '', Upload::save($file)));
                }
            } else {
                self::recursive_upload_files($fields[$key], $file);
            }
        }
    }

    //converts two dimensional files to normal view
    public static function convert_files(&$fields, $files) {
        $multi_files = array();
        foreach($files as $key=>$file) {
            if (!is_array($file['name'])) {
                if (Upload::valid($file) && Upload::not_empty($file)) {
                    //booo, scary!
                    $fields[$key] = Upload::$default_directory.'/'.str_replace(DIRECTORY_SEPARATOR, '/', str_replace(realpath(Upload::$default_directory).DIRECTORY_SEPARATOR, '', Upload::save($file)));
                }
            } else {
                $multi_files[$key] = array();
                foreach($file as $prop => $values) {
                    self::recursive_convert_files($multi_files[$key], $values, $prop);
                }
            }
        }
        self::recursive_upload_files($fields, $multi_files);
    }

    public function save(ORM $model, $fields, $files = null) {
        if ($files) {
            self::convert_files($fields, $files);
        }

        self::recursive_update_fields($model, $fields);
    }

    public function action_literal() {
        if ($this->request->method() == 'POST') {
            $literals = $this->request->post('literal');
            foreach($literals as $id=>$trs) {
                foreach($trs as $lang=>$tr) {
                    $t = ORM::factory('Literal', array('id' => $id, 'lang' => $lang));
                    if (!$t->loaded()) {
                        $t = ORM::factory('Literal');
                        $t->id = $id;
                        $t->lang = $lang;
                    }
                    $t->translation = $tr;
                    $t->save();
                }
            }
            $this->redirect('control/literal');
        }
        $this->template->content = View::factory('control/literals', array(
            'literals' => ORM::factory('Literal')->select('id')->distinct(true)->find_all(),
            'languages' => ORM::$languages,
        ));
    }

    public function default_handler($type) {
        $model_name = ucfirst($type);
        $id = $this->request->param('id');
		$filters = $this->request->query('filters');
        if ($id == null) {
            $per_page = 10;
            $items = ORM::factory($model_name);
            if (is_array($filters)) {
                foreach($filters as $k=>$v) {
                    $items->where($k, '=', $v);
                }
            }
            $items->reset(false);
            $cnt = $items->count_all();
            $page_count = ceil($cnt/$per_page);
            $page = $this->request->query('page');
            if (!$page) {
                $page = 1;
            }
            $items->offset($per_page*($page - 1))->limit($per_page);
            $items = $items->find_all();
            $this->template->content = View::factory('control/default_list', array(
                'items' => $items,
                'type' => $type,
                'model' => $model_name,
                'pages' => $page_count,
                'current_page' => $page,
                'filters' => $filters,
            ));
        } else {
			$back_url = 'control/'.$type;
			if (is_array($filters)) {
				$back_url .= '?'.http_build_query(array('filters' => $filters));
			}
            $item = ORM::factory($model_name, $id?$id:null);
			//auto fill fields
			if (is_array($filters)) {
				foreach($filters as $k => $v) {
					$item->$k = $v;
				}
			}
            $op = $this->request->param('operation');
            if ($id && ($op == 'delete')) {
                $item->delete();
                $this->redirect($back_url);
            }
            $errors = false;
            if ($this->request->method() == 'POST') {
                $post = $this->request->post();
                try {
                    $delete = $this->request->post('__delete');
					if ($delete !== null) {
						unset($post['__delete']);
					}
					$detach = $this->request->post('__detach');
                    if ($detach !== null) {
                        unset($post['__detach']);
                    }
                    $this->save($item, $post, $_FILES);
                    if ($delete) {
                        foreach($delete as $model=>$ids) {
                            foreach($ids as $rid=>$tmp) {
                                ORM::factory($model, $rid)->delete();
                            }
                        }
                    }
					if (is_array($detach)) {
						foreach($detach as $field=>$ids) {
							$item->remove($field, array_keys($ids));
						}
					}
                } catch(ORM_Validation_Exception $e) {
                    $errors = $e->errors();
                }
                if (!$errors) {
                    $this->redirect($back_url);
                }
            }
            $this->template->content = View::factory('control/default', array(
                'item' => $item,
                'errors' => $errors,
            ));
        }
    }

    public function action_index() {
        $type = $this->request->param('type');
        if ($type != null) {
            $method = 'action_'.$type;
            $this->template->active_menu = $type;
            if (method_exists($this, $method)) {
                $this->$method();
            } else {
                $this->default_handler($type);
            }
        } else {
            $this->template->content = View::factory('control/index');
        }
    }
}
