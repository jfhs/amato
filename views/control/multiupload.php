<div id="fileupload">
    <div class="fileupload-buttonbar">
        <div class="span7">
            <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="icon-plus icon-white"></i>
                    <span>Добавить файл</span>
                    <input type="file" name="files[]" multiple>
                </span>
            <button type="submit" class="btn btn-primary start" style="margin-bottom: 10px !important;margin-left: 0px!important;margin-right: 0px!important;margin-top: 0px!important;">
                <i class="icon-upload icon-white"></i>
                <span>Загрузить</span>
            </button>
            <button type="reset" class="btn btn-warning cancel">
                <i class="icon-ban-circle icon-white"></i>
                <span>Отменить</span>
            </button>
            <button type="button" class="btn btn-danger delete">
                <i class="icon-trash icon-white"></i>
                <span>Удалить</span>
            </button>
            <input type="checkbox" class="toggle">
        </div>
        <!-- The global progress information -->
        <div class="span5 fileupload-progress fade">
            <!-- The global progress bar -->
            <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                <div class="bar" style="width:0%;"></div>
            </div>
            <!-- The extended global progress information -->
            <div class="progress-extended">&nbsp;</div>
        </div>
    </div>
    <!-- The loading indicator is shown during file processing -->
    <div class="fileupload-loading"></div>
    <br>
    <!-- The table listing the files available for upload/download -->
    <table role="presentation" class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
</div>

<!-- modal-gallery is the modal dialog used for the image gallery -->
<div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd" tabindex="-1">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
        <a class="btn modal-download" target="_blank">
            <i class="icon-download"></i>
            <span>Скачать</span>
        </a>
        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000">
            <i class="icon-play icon-white"></i>
            <span>Слайдшоу</span>
        </a>
        <a class="btn btn-info modal-prev">
            <i class="icon-arrow-left icon-white"></i>
            <span>Назад</span>
        </a>
        <a class="btn btn-primary modal-next">
            <span>Вперёд</span>
            <i class="icon-arrow-right icon-white"></i>
        </a>
    </div>
</div>

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td class="name"><span>{%=file.name%}</span></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        {% if (file.error) { %}
        <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else if (!i) { %}
        <td>
            <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
        </td>
        <td class="start">{% if (!o.options.autoUpload) { %}
            <button class="btn btn-primary">
                <i class="icon-upload icon-white"></i>
                <span>Загрузить</span>
            </button>
            {% } %}</td>
        {% } else { %}
        <td colspan="2"></td>
        {% } %}
        <td class="cancel">{% if (!i) { %}
            <button class="btn btn-warning">
                <i class="icon-ban-circle icon-white"></i>
                <span>Отмена</span>
            </button>
            {% } %}</td>
    </tr>
    {% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade" data-id="{%=file.id%}">
        {% if (file.error) { %}
        <td></td>
        <td class="name"><span>{%=file.name%}</span></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else { %}
        <td class="preview">{% if (file.thumbnail_url) { %}
            <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
            {% } %}</td>
        <td class="name">
            <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
        </td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        <td colspan="2"></td>
        {% } %}
        <td>
            <button class="btn btn-danger delete" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
            <i class="icon-trash icon-white"></i>
            <span>Удалить</span>
            </button>
            <input type="checkbox" class="toggle" name="delete" value="1">
        </td>
    </tr>
    {% } %}
</script>
<?= HTML::script('media/js/jQuery-File-Upload-8.2.1/js/vendor/jquery.ui.widget.js')?>
<?= HTML::script('media/js/jQuery-File-Upload-8.2.1/js/vendor/tmpl.min.js')?>
<?= HTML::script('media/js/jQuery-File-Upload-8.2.1/js/vendor/load-image.min.js')?>
<?= HTML::script('media/js/jQuery-File-Upload-8.2.1/js/vendor/canvas-to-blob.min.js')?>
<?= HTML::script('media/js/jQuery-File-Upload-8.2.1/js/vendor/bootstrap-image-gallery.min.js')?>
<?= HTML::script('media/js/jQuery-File-Upload-8.2.1/js/jquery.iframe-transport.js')?>
<?= HTML::script('media/js/jQuery-File-Upload-8.2.1/js/jquery.fileupload.js')?>
<?= HTML::script('media/js/jQuery-File-Upload-8.2.1/js/jquery.fileupload-process.js')?>
<?= HTML::script('media/js/jQuery-File-Upload-8.2.1/js/jquery.fileupload-resize.js')?>
<?= HTML::script('media/js/jQuery-File-Upload-8.2.1/js/jquery.fileupload-validate.js')?>
<?= HTML::script('media/js/jQuery-File-Upload-8.2.1/js/jquery.fileupload-ui.js')?>
<!-- The main application script -->
<script type="text/javascript">

    $(function(){
        $('#fileupload').fileupload({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: <?= json_encode(URL::site('control/album/'.$album->id.'/upload'))?>,
            maxFileSize: 5000000,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            autoUpload: false
        });
        $('#fileupload').addClass('fileupload-processing');
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: $('#fileupload').fileupload('option', 'url'),
            dataType: 'json',
            context: $('#fileupload')[0]
        }).always(function (result) {
                $(this).removeClass('fileupload-processing');
            }).done(function (result) {
                $(this).fileupload('option', 'done')
                    .call(this, null, {result: result});
            });

        $('#submitForm').on('click', function(){
            var arr = Array();
            $('.template-download').each(function(i,e){
                arr[i] = $(e).data('id');
            })
            $('#files_id').val(arr);
            $('#formsave').submit();
        })
        $('#lang').on('change', function(){
            var val = $(this).val();
            $('.lang_block').hide();
            $('.lang_'+val).show();
        })
    })

</script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
<!--[if gte IE 8]><?= HTML::script('media/js/jQuery-File-Upload-8.2.1/js/cors/jquery.xdr-transport.js')?><![endif]-->
