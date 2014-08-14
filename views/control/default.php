<h3><?php echo $item->loaded()?'Редактирование':'Создание'?> <?php echo htmlspecialchars($item->object_title())?></h3>

<?php echo Form::select('', ORM::$languages, I18n::lang(), array('id' => 'lang_select'))?>

<?php if (isset($tabs)):?>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#props" data-toggle="tab">Общие</a></li>
        <?php
            if (isset($tabs)):
               $i=0;
               foreach($tabs as $tabname=>$tab):
        ?>
        <li><a href="#tab<?= $i?>" data-toggle="tab"><?= $tabname?></a></li>
        <?php
                    ++$i;
                endforeach;
            endif;
        ?>
    </ul>
<?php endif;?>
<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="tab-content">
        <div id="props" class="tab-pane active">
        <?php foreach($item->editable_fields() as $name=>$field):?>

            <label ><h5><?php echo htmlspecialchars($field['title'])?></h5></label>
            <?php if (isset($field['language'])):?>
                <?php foreach(ORM::$languages as $language=>$tmp):?>
                <div data-lang="<?php echo $language?>"<?php echo ($language == 'ru')?'':' style="display: none;"'?>>
                    <?php echo View::factory('control/editors/'.$field['type'], array(
                    'item' => $item,
                    'field' => $name.'_'.$language,
                    'params' => $field,
                ))?>
                </div>
                <?php endforeach;?>
            <?php else:?>
            <div >
                <?php echo View::factory('control/editors/'.$field['type'], array(
                'item' => $item,
                'field' => $name,
                'params' => $field,
            ))?>
            </div>
            <?php endif;?>
        <?php endforeach;?>
        </div>
        <?php
        if (isset($tabs)):
            $i=0;
            foreach($tabs as $tabname=>$tab):
                ?>
        <div id="tab<?= $i?>" class="tab-pane">
            <?= $tab?>
        </div>
                <?php
                ++$i;
            endforeach;
        endif;
        ?>
    </div>
    <div class="control-group">
        <div class="controls">
            <?php echo Form::submit('', 'Сохранить', array('class' => 'btn btn-primary','style' => 'position: relative; right: 180px;top: 10px'))?>
        </div>
    </div>
</form>