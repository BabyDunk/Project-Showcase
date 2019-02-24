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

    <h3> Welcome {{($user->privilege) ? 'Admin' : 'Dev'}} </h3>

    <div class="image-holder text-center">
        <img src="{{$user->image_path_placeholder()}}" alt="{{$user->first_name}}" title="Admin" >

        <p>{{$user->first_name}} {{$user->last_name}}</p>
    </div>
    <ul class="vertical menu">
        <li>
            <a href="/sc-panel"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        @if(!empty($user->privilege))
        <li>
            <a href="/sc-panel/users"><i class="fa fa-fw fa-users"></i> Users</a>
        </li>
        @endif
        <li>
            <a href="/sc-panel/uploads"><i class="fa fa-fw fa-table"></i> Upload</a>
        </li>
        <li>
            <a href="/sc-panel/showcase"><i class="fa fa-fw fa-table"></i> Showcases</a>
        </li>
        @if(!empty($user->privilege))
        <li>
            <a href="/sc-panel/contacts"><i class="fa fa-fw fa-edit"></i> Contacts</a>
        </li>
        @endif
        <li>
            <a href="/sc-panel/comments"><i class="fa fa-fw fa-comments-o"></i> Comments</a>
        </li>
        @if(!empty($user->privilege))
        <li>
            <a href="/sc-panel/statistics"><i class="fa fa-fw fa-bar-chart-o"></i> Statistics</a>
        </li>
        <li>
            <ul class="vertical menu" data-accordion-menu>
                <li>
                    <a href="#"><i class="fa fa-fw fa-wrench"></i> Settings</a>
                    <ul class="menu vertical nested">
                        <li><a href="/sc-panel/general_settings"><i class="fa fa-arrow-circle-right"></i> General</a></li>
                        <li><a href="/sc-panel/email_settings"><i class="fa fa-envelope"></i> Email</a></li>
                        <li><a href="/sc-panel/social_settings"><i class="fa fa-share-square" aria-hidden="true"></i> Social</a></li>
                        <li><a href="/sc-panel/logging_settings"><i class="fa fa-history" aria-hidden="true"></i> Logging</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        @endif
    </ul>

</div>
