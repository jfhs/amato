<?php if ($item->$field):?>
    <?php echo HTML::anchor(URL::base(true).$item->$field, 'Скачать');?><br>
<?php endif;?>
<?php echo Form::file($field)?>
<?php if ($item->$field):?>
    <br>
    <?php echo Form::checkbox($field, '');?>&nbsp;Удалить
<?php endif;?>