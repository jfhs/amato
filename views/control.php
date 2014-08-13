<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Админпанель</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <?php echo HTML::style($assets_path.'js/jquery.loadmask.css');?>
    <?php echo HTML::style($assets_path.'css/bootstrap.css');?>
    <?php echo HTML::style($assets_path.'js/jquery-ui-1.10.2/themes/base/jquery-ui.css');?>

    <style type="text/css">
        body {
            padding-top: 60px;
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }
    </style>
    <?php echo HTML::style($assets_path.'css/bootstrap-responsive.css');?>
	<?php echo HTML::style($assets_path.'css/tagmanager.css');?>
    <?php echo HTML::style($assets_path.'css/admin.css');?>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <?php echo HTML::script($assets_path.'js/jquery.js');?>
    <?php echo HTML::script($assets_path.'js/jquery-ui-1.10.2/ui/minified/jquery-ui.min.js');?>
    <?php echo HTML::script($assets_path.'js/jquery-ui-1.10.2/ui/i18n/jquery.ui.datepicker-ru.js');?>
    <?php echo HTML::script($assets_path.'js/bootstrap.min.js');?>
    <?php echo HTML::script($assets_path.'js/ckeditor/ckeditor.js');?>
    <?php echo HTML::script($assets_path.'js/ckfinder/ckfinder.js');?>
	<?php echo HTML::script($assets_path.'js/tagmanager.js');?>
    <?php echo HTML::script($assets_path.'js/admin.js');?>
</head>

<body style="padding-top: 0px;">

<div class="navbar navbar-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
           <!-- <a class="brand" href="#">Панель администратора</a> -->
            <div class="nav-collapse collapse">
                <p class="navbar-text pull-right">
                    <?php echo HTML::anchor('logout', 'Выйти', array('class' => 'navbar-link'))?>
                </p>
                <ul class="nav">
                    <?php foreach($menu as $name=>$data):?>
                    <?php if (!isset($data['sub']) || !$data['sub']):?>
                    <li<?php echo ($name == $active_menu)?' class="active"':''?>><?php echo HTML::anchor($data['link'], $data['title'])?></li>
                    <?php else:?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo htmlspecialchars($data['title'])?>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <?php foreach($data['sub'] as $name2=>$data2):?>
                                <li><?php echo HTML::anchor($data2['link'], $data2['title'])?></li>
                                <?php endforeach;?>
                            </ul>
                        </li>

                        <?php endif;?>
                    <?php endforeach;?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="container-fluid">
    <?php echo $content?>

    <hr>


</div><!--/.fluid-container-->

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>
    var baseUrl = '<?php echo URL::site()?>';
</script>

</body>
</html>
