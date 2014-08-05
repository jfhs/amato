<?php echo HTML::script('jscripts/tiny_mce/jquery.tinymce.js');?>
<?php echo HTML::script('jscripts/tiny_mce/tiny_mce.js');?>

<script type="text/javascript">
    tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Example content CSS (should be your site CSS)
        content_css : "css/content.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "lists/template_list.js",
        external_link_list_url : "lists/link_list.js",
        external_image_list_url : "lists/image_list.js",
        media_external_list_url : "lists/media_list.js",
        file_browser_callback : "AjexFileManager.open",

        // Replace values for the template plugin
        template_replace_values : {
            username : "Some User",
            staffid : "991234"
        }
    });


    AjexFileManager.init({
        returnTo: 'tinymce',
        path: 'AjexFileManager/'
    });
</script>
<h5><?php echo $page->loaded()?'Редактирование':'Создание'?> страницы</h5>
<form class="form-horizontal" method="post">
    <div class="control-group">
        <label class="control-label">Название</label>
        <div class="controls">
            <?php echo Form::input('title', $page->title, array('class' => 'span12'))?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Название в URL</label>
        <div class="controls">
            <?php echo Form::input('url', $page->url, array('class' => 'span12'))?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Текст</label>
        <div class="controls">
            <?php echo Form::textarea('text', $page->text, array('class' => 'span12'))?>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <?php echo Form::submit('', 'Сохранить', array('class' => 'btn btn-primary'))?>
        </div>
    </div>
</form>