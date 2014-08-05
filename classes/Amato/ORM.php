<?php

class Amato_ORM extends Kohana_ORM {

    public function editable_fields() {
        return array();
    }

	public function table_fields() {
		return array();
	}

	public function object_title() {
		return $this->object_name();
	}

	public function title() {
		return $this->title;
	}

    public function link() {
        return '#';
    }

    public function has_any_language() {
        $fields = $this->editable_fields();
        foreach($fields as $field) {
            if (isset($field['language'])) {
                return true;
            }
        }
        return false;
    }

    public function has_column($column) {
        $columns = $this->table_columns();
        return is_array($columns) && isset($columns[$column]);
    }

	public function allows_add() {
		return true;
	}

    public function has_seo() {
        return false;
    }

    public function categories() {
        return false;
    }

    public function category_add_link() {
        return false;
    }
}