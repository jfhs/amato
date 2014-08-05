<?php
    $variants = ORM::factory($params['model']);
    $variants = $variants->find_all()->as_array($variants->primary_key(), $params['rel_title']);
    if (isset($params['null']) && $params['null']) {
        $variants = array(0 => $params['null']) + $variants;
    }
?>
<table>
<?php foreach($item->$field->find_all() as $v):?>
	<tr>
		<td>
			<?php echo Form::select($field.'[]', $variants, $v->pk())?>
		</td>
		<td>
			<?php echo Form::checkbox('__detach['.$field.']['.$v->pk().']', 1)?> Удалить
		</td>
	</tr>
<?php endforeach;?>
	<tr>
		<td>
			<?php echo Form::select($field.'[]', $variants)?>
		</td>
		<td>&nbsp;</td>
	</tr>
</table>
<a href="#" class="add_more_related" data-fname="<?php echo htmlspecialchars($field)?>">Добавить</a>