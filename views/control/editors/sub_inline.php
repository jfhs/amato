<?php
$cols = $params['columns'];
$null = ORM::factory($item->$field->object_name());
?>
<table class="sub_inline">
    <tr>
    <?php foreach($cols as $sub_field => $col):?>
        <th><?php echo htmlspecialchars($col['title'])?></th>
    <?php endforeach?>
        <th>Удалить</th>
    </tr>
    <?php foreach($item->$field->find_all() as $sub):?>
    <tr>
        <?php foreach($cols as $sub_field => $col):?>
            <td>
                <?php echo View::factory('control/editors/'.$col['type'], array('item' => $sub,
                    'params' => $col, 'field' => $sub_field, 'name' => $field.'['.$sub->pk().']['.$sub_field.']'))?>
            </td>
        <?php endforeach?>
        <td>
            <?php echo Form::checkbox('__delete['.$sub->object_name().']['.$sub->pk().']', 1)?>
        </td>
    </tr>
    <?php endforeach?>
    <tr data-id="-1">
        <?php foreach($cols as $sub_field => $col):?>
            <td>
                <?php echo View::factory('control/editors/'.$col['type'], array('item' => $null,
                    'params' => $col, 'field' => $sub_field, 'name' => $field.'[-1]['.$sub_field.']'))?>
            </td>
        <?php endforeach?>
        <td>
            <?php echo Form::checkbox('__delete['.$null->object_name().'][-1]', 1, true)?>
        </td>
    </tr>
</table>

<a href="#" class="add_more_sub" data-fname="<?php echo htmlspecialchars($field)?>">Добавить</a>