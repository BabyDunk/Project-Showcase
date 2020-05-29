<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 26/05/2018
	 * Time: 12:16
	 */


	?>


<header id="shop-header">
    <nav id="nav-bar">
        <div id="nav">
            <div class="logo">
                <a href="/shop" ><img src="{{sca_get_logo()}}" id="header-img"></a>
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
                <a href="/"><img src="{{ASSETS_IMAGES_PATH_URL}}logo.jpg" class="header-img"></a>
            </div>
            <div id="nav-small">
                <div class="home"><a class="nav-link" href="#triCard">Get Started</a></div>
                <div class="sales"><a class="nav-link" href="#sales-div">Sales</a></div>
                <div class="contact"><a class="nav-link" href="#contact-div">Contact</a></div>
            </div>
        </div>
    </nav>
</header>