<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Войти</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <?php echo HTML::style('media/css/bootstrap.css');?>
    <style type="text/css">
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            max-width: 300px;
            padding: 19px 29px 29px;
            margin: 0 auto 20px;
            background-color: #fff;
            border: 1px solid #e5e5e5;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
            -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
            box-shadow: 0 1px 2px rgba(0,0,0,.05);
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }
        .form-signin input[type="text"],
        .form-signin input[type="password"] {
            font-size: 16px;
            height: auto;
            margin-bottom: 15px;
            padding: 7px 9px;
        }

    </style>
    <?php echo HTML::style('media/css/bootstrap-responsive.css');?>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="ico/favicon.png">
</head>

<body>

<div class="container">

    <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Введите логин и пароль</h2>
        <input type="text" name="login" class="input-block-level" placeholder="Логин">
        <input type="password" name="password" class="input-block-level" placeholder="Пароль">
        <button class="btn btn-large btn-primary" type="submit">Войти</button>
    </form>

</div> <!-- /container -->

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php echo HTML::script('media/js/jquery.js');?>
<?php echo HTML::script('media/js/bootstrap-transition.js');?>
<?php echo HTML::script('media/js/bootstrap-alert.js');?>
<?php echo HTML::script('media/js/bootstrap-modal.js');?>
<?php echo HTML::script('media/js/bootstrap-dropdown.js');?>
<?php echo HTML::script('media/js/bootstrap-scrollspy.js');?>
<?php echo HTML::script('media/js/bootstrap-tab.js');?>
<?php echo HTML::script('media/js/bootstrap-tooltip.js');?>
<?php echo HTML::script('media/js/bootstrap-popover.js');?>
<?php echo HTML::script('media/js/bootstrap-button.js');?>
<?php echo HTML::script('media/js/bootstrap-collapse.js');?>
<?php echo HTML::script('media/js/bootstrap-carousel.js');?>
<?php echo HTML::script('media/js/bootstrap-typeahead.js');?>

</body>
</html>
