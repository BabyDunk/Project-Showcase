<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 27/05/2018
	 * Time: 13:33
	 */?>

<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>

        <meta charset="{{DB_CHARSET}}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>@yield('title')</title>

        <!-- Bundled CSS -->
        <link href="<?php sca_base_url(); ?>resources/assets/css/bundle.css" rel="stylesheet">


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body data-page-id="@yield('page-id')">

        <div id="wrapper">

            @yield('content')

        </div>
        <!-- /#wrapper -->

        <!-- Bundled JS -->
        <script src="<?php sca_base_url(); ?>resources/assets/js/bundle.js" type="text/javascript" ></script>

    </body>
</html>

