<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 26/05/2018
	 * Time: 12:16
	 */


	?>


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
            <li><a href="{{sca_get_preference('showcase', 'sca_siteurl')}}shop#contact" {{--data-smooth-scroll--}}>Contact</a></li>
            <li>@php echo ($user_id) ? '<a href="/sc-panel">User Panel</a>' : '<a href="/sc-panel/login">Login</a>' ; @endphp</li>
        </ul>
    </div>
</div>
