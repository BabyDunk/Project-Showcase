<?php


?>


<!DOCTYPE html>
<html class="no-js" lang="en">

<head>

    <meta charset="{{DB_CHARSET}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="{{}}">

    <title>@yield('title')</title>

    <!-- Bundled CSS -->
    <link href="<?php sca_base_url(); ?>resources/assets/front/css/bundle.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
          integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="@yield('page-id')" data-page-id="@yield('page-id')">




@yield('content')



<!-- Footer -->
<footer>
    <!-- Footer Content -->
    <div class="container">
        <hr/>
        <div class="text-center">
            <p>Copyright &copy; <a
                        href="mailto:{{sca_get_preference('showcase', 'sca_sitecontact')}}">{{sca_get_preference('showcase', 'sca_sitename')}}</a>
                2018 - <?php echo date( 'y' ); ?></p>
        </div>
    </div>
</footer>


<!-- base script -->
@php loadScripts() @endphp

</body>

</html>

