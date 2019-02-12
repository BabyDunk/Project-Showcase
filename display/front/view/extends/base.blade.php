<?php


?>


<!DOCTYPE html>
<html class="no-js" lang="en">

<head>

    <meta charset="{{DB_CHARSET}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom CSS -->
    <link href="<?php sca_base_url(); ?>resources/assets/front/css/style.css" rel="stylesheet">
    <link href="<?php sca_base_url(); ?>node_modules/motion-ui/dist/motion-ui.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body data-page-id="@yield('page-id')">


<!-- Navigation -->
@include('includes.navigation')



    @yield('content')



<!-- Footer -->
<footer>
    <!-- Page Content -->
    <div class="grid-container">
        <hr/>
        <div class="text-center">
            <p>Copyright &copy; {{sca_get_preference('showcase', 'sca_sitename')}} 2018 - <?php echo date('y'); ?></p>
        </div>
        <!-- /.large-12 -->
    </div>
    <!-- /.grid-container-->
</footer>

<!-- jQuery -->
<script src="<?php sca_base_url(); ?>node_modules/jquery/dist/jquery.min.js"></script>
<!-- jQuery-ui -->
<script src="<?php sca_base_url(); ?>node_modules/jquery-ui/ui/jquery-1-7.js"></script>


<!-- Zurb Foundation JavaScript -->
<script src="<?php sca_base_url(); ?>node_modules/what-input/dist/what-input.min.js"></script>
<script src="<?php sca_base_url(); ?>node_modules/motion-ui/dist/motion-ui.min.js"></script>
<script src="<?php sca_base_url(); ?>node_modules/foundation-sites/dist/js/foundation.js"></script>


<!-- base script -->
<script src="<?php sca_base_url(); ?>resources/assets/js/scripts.js" type="text/javascript" ></script>

</body>

</html>

