<h5><?php echo $menu->loaded()?'Редактирование':'Создание'?> пункта меню</h5>
<form class="form-horizontal" method="post">
    <div class="control-group">
        <label class="control-label">Название</label>
        <div class="controls">
            <?php echo Form::input('title', $menu->title, array('class' => 'span12'))?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Ссылка</label>
        <div class="controls">
            <?php echo Form::input('link', $menu->link, array('class' => 'span12'))?>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <?php echo Form::submit('', 'Сохранить', array('class' => 'btn btn-primary'))?>
        </div>
    </div>
</form>