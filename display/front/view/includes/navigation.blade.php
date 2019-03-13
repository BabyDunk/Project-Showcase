<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 26/05/2018
	 * Time: 12:16
	 */


	?>


{{--
<div class="top-bar">
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text"><a href="{{sca_get_preference('showcase', 'sca_siteurl')}}" rel="" target="_self" hreflang="en">{{sca_get_preference('showcase', 'sca_sitename')}}</a></li>
        </ul>
    </div>
    <div class="top-bar-right">
        <ul class="dropdown menu" data-dropdown-menu>
            <li><a href="/">Home</a></li>
            <li><a href="/shop">Shop</a></li>
            <li><a href="{{sca_get_preference('showcase', 'sca_siteurl')}}shop#contact" --}}
{{--data-smooth-scroll--}}{{--
>Contact</a></li>
            <li>@php echo ($user_id) ? '<a href="/sc-panel">User Panel</a>' : '<a href="/sc-panel/login">Login</a>' ; @endphp</li>
        </ul>
    </div>
</div>
--}}

<header id="header">
    <nav id="nav-bar">
        <div id="nav">
            <div class="logo">
                <a href="/" ><img src="{{ASSETS_IMAGES_PATH_URL}}cylinder-code-2-logo300x250.png" id="header-img"></a>
            </div>
            <div class="home">
                <a class="nav-link" href="#triCard">Get Started</a>
            </div>
            <div class="sales">
                <a class="nav-link" href="#sales-div">Sales</a>
            </div>
            <div class="contact">
                <a class="nav-link" href="#contact-div">Contact</a>
            </div>
        </div>
    </nav>
    <nav id="nav-bar-small">
        <div id="nav-bar-navi">
            <span id="nav-show-menu" class="fas fa-bars"></span>
            <div class="logo">
                <a href="/"><img src="{{ASSETS_IMAGES_PATH_URL}}cylinder-code-2-logo300x250.png" class="header-img"></a>
            </div>
            <div id="nav-small">
                <div class="home"><a class="nav-link" href="#triCard">Get Started</a></div>
                <div class="sales"><a class="nav-link" href="#sales-div">Sales</a></div>
                <div class="contact"><a class="nav-link" href="#contact-div">Contact</a></div>
            </div>
        </div>
    </nav>
</header>