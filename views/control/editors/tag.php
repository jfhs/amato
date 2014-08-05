<?php
$id = 'tag_'.$item->pk().'_'.$field;
echo Form::input('', '', array('id' => $id));
$p = array(
	'prefilled' => explode(',', $item->$field),
	'typeahead' => true,
	'preventSubmitOnEnter' => false,
	'hiddenTagListName' => $field,
);
if (isset($params['max'])) {
	$p['maxTags'] = $params['max'];
}
if (isset($params['values'])) {
	$p['typeaheadSource'] = $params['values'];
}
?>
<div style="clear:both"></div>
<script>
	$(<?= json_encode('#'.$id)?>).tagsManager(<?= json_encode($p)?>)
</script>