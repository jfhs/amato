<h5><?php echo $category->loaded()?'Редактирование':'Создание'?> категории</h5>
<form class="form-horizontal" method="post">
    <div class="control-group">
        <label class="control-label">Название</label>
        <div class="controls">
            <?php echo Form::input('title', $category->title, array('class' => 'span12'))?>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <?php echo Form::submit('', 'Сохранить', array('class' => 'btn btn-primary'))?>
        </div>
    </div>
</form>