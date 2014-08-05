<?php foreach($item->$field->find_all() as $image):?>
    <?php echo HTML::image($image->{$params['image_field']}, array('width' => 200));?><br>
    <?php echo Form::checkbox('__delete['.$item->$field->object_name().']['.$image->id.']', '1')?>Удалить<br>
<?php endforeach;?>
<?php echo Form::file($field.'[-1]['.$params['image_field'].']')?><br>
<a href="#" class="add_more_images" data-fname="<?php echo htmlspecialchars($field)?>" data-propname="<?php echo htmlspecialchars($params['image_field'])?>" data-lastindex="-1">Добавить</a>
