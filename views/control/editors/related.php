<?php
    $variants = ORM::factory($params['model']);
    $variants = $variants->find_all()->as_array($variants->primary_key(), $params['rel_title']);
    if (isset($params['null']) && $params['null']) {
        $variants = array(0 => $params['null']) + $variants;
    }
?>
<?php echo Form::select($field, $variants, $item->$field)?>