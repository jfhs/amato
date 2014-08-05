<?php echo Form::textarea($field, $item->$field, array('class' => 'span12', 'id' => $field))?>
<script>
    var editor;
    if(typeof CKEDITOR.instances[<?php echo json_encode($field)?>] != 'undefined')
        delete(CKEDITOR.instances[<?php echo json_encode($field)?>]);
    editor =  CKEDITOR.replace( <?php echo json_encode($field)?> );
    CKFinder.setupCKEditor( editor, '/media/js/ckfinder/' );
</script>