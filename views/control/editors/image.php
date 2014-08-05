<?php if ($item->$field):?>
    <?php echo HTML::image($item->$field, array('width' => 200));?><br>
<?php endif;?>
<?php echo Form::file($field)?>
<?php if ($item->$field):?>
    <br>
    <?php echo Form::checkbox($field, '');?>&nbsp;Удалить
<?php endif;?>