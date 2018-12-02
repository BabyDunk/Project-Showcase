<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 27/05/2018
	 * Time: 13:22
	 */

	$user = \Classes\Core\User::find_by_id($userid);

	?>


<!-- Sidebar -->
<div class="off-canvas position-left reveal-for-large nav" id="offCanvas" data-off-canvas>

    <h3> Welcome Admin </h3>

    <div class="image-holder text-center">
        <img src="{{$user->image_path_placeholder()}}" alt="{{$user->first_name}}" title="Admin" >

        <p>{{$user->first_name}} {{$user->last_name}}</p>
    </div>
    <ul class="vertical menu">
        <li>
            <a href="/admin"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        @if(!empty($user->privilege))
        <li>
            <a href="/admin/users"><i class="fa fa-fw fa-users"></i> Users</a>
        </li>
        @endif
        <li>
            <a href="/admin/uploads"><i class="fa fa-fw fa-table"></i> Upload</a>
        </li>
        <li>
            <a href="/admin/showcase"><i class="fa fa-fw fa-table"></i> Showcases</a>
        </li>
        <li>
            <a href="/admin/comments"><i class="fa fa-fw fa-edit"></i> Comments</a>
        </li>
        @if(!empty($user->privilege))
        <li>
            <a href="/admin/statistics"><i class="fa fa-fw fa-bar-chart-o"></i> Statistics</a>
        </li>
        <li>
            <ul class="vertical menu" data-accordion-menu>
                <li>
                    <a href="#"><i class="fa fa-fw fa-wrench"></i> Settings</a>
                    <ul class="menu vertical nested">
                        <li><a href="/admin/general_settings"><i class="fa fa-arrow-circle-right"></i> General</a></li>
                        <li><a href="/admin/email_settings"><i class="fa fa-envelope"></i> Email</a></li>
                        <li><a href="/admin/social_settings"><i class="fa fa-share-square" aria-hidden="true"></i> Social</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        @endif
    </ul>

</div>
