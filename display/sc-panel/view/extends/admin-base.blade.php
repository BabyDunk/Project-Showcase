<?php
/**
 * Created by Chris Wilkinson.
 * Title: oop
 * Date: 27/05/2018
 * Time: 13:17
 */


if(!\Classes\Core\Session::instance()->is_signed_in()) { redirect('/sc-panel/login'); }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom CSS -->
    <link href="<?php sca_base_url(); ?>resources/assets/sc-panel/css/style.css" rel="stylesheet">

    <!-- Bootstrap Colorpciker style -->
    <link href="<?php sca_base_url(); ?>vendor/itsjavi/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body data-page-id="@yield('page-id')">
<div id="wrapper">

    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    @include( "includes.side-bar" )
    <!-- /.navbar-collapse -->






    <div class="off-canvas-content admin_title_bar" data-off-canvas-content>
        <!-- Title bar -->
        @include("includes.top-nav")

        <!-- Your page content lives here -->
        @yield('content')

    </div>


</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="<?php sca_base_url(); ?>resources/assets/bower/bower_components/jquery/dist/jquery.js"></script>
<!-- jQuery-ui -->
<script src="<?php sca_base_url(); ?>resources/assets/bower/bower_components/jquery-ui/jquery-ui.js"></script>

<!-- Zurb Foundation JavaScript -->
<script src="<?php sca_base_url(); ?>resources/assets/bower/bower_components/foundation-sites/dist/js/foundation.js"></script>
{{--<!-- Bootstrap Color Picker -->
<script src="<?php sca_base_url(); ?>vendor/itsjavi/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js"></script>--}}

<!-- Color Picker -->
<script src="<?php sca_base_url(); ?>resources/assets/bower/bower_components/iris/dist/iris.js"></script>

<!-- WYSIWYG Tiny mce Editor -->
<script src="<?php sca_base_url(); ?>resources/assets/sc-panel/js/tinymce/tinymce.min.js"></script>

<!-- Google Charts Loader -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script src="<?php sca_base_url(); ?>resources/assets/js/scripts.js" type="text/javascript" ></script>


<!-- Google 3D Chart Initializer -->
<script type="text/javascript">
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Stats', 'Complete daily stats'],
            ['Views',     <?php echo $sess->count; ?>],
            ['Showcases',      <?php echo \Classes\Core\Showcase::count_all(); ?>],
            ['Users',  <?php echo \Classes\Core\User::count_all(); ?>],
            ['Comments', <?php echo \Classes\Core\Comment::count_all(); ?>]
        ]);

        var options = {
            backgroundColor: 'transparent',
            fontName: 'serif',
            legend: 'none',
            title: 'My Daily Usage',
            pieSliceText: 'label',
            is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
    }
</script>
</body>
</html>
