<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 27/05/2018
	 * Time: 13:20
	 */
	$user = \Classes\Core\User::find_by_id($userid);
	$showcases = \Classes\Core\Showcase::find_by_user_id($userid);
	$comments = [];

	if ( ! empty( $showcases ) )
	{
		foreach ( $showcases as $item )
		{
			$comments = array_merge( $comments , (array) \Classes\Core\Comment::find_by_show_id( $item->id ) );
		}
	}
	/*echo "<pre>";
	print_r($comments);
	echo "</pre>";*/

	?>

<div class="top-bar"
>
    <div class="top-bar-left">
        <ul class="menu" >
            <li><button class="menu-icon hide-for-large" type="button" data-open="offCanvas"></button></li>
            <li class="menu-text"><a href="{{sca_get_preference('showcase', 'sca_siteurl')}}"> Visit - {{sca_get_preference('showcase', 'sca_sitename')}}</a></li>
        </ul>
    </div>
    <div class="top-bar-right">
        <ul class="dropdown menu" data-dropdown-menu>
            <li>
                <a href="#"><i class="fa fa-envelope"></i></a>
                <ul class="menu vertical">
                    @foreach($comments as $comment)
                    <li class="message-preview">
                        <a href="#">
                            <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                <div class="media-body">
                                    <h5 class="media-heading">
                                        <strong>{{$comment->author}}</strong>
                                    </h5>
                                    <p class="small text-muted"><i class="fa fa-clock-o"></i> @php

                                            $createdDate = new DateTime($comment->created_at);

                                            date_format($createdDate, 'm ([ .\t-])* dd [,.stndrh\t ]+ y') @endphp </p>
                                    <p>{{$comment->body}}</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endforeach
                    <li class="message-footer">
                        <a href="#">Read All New Messages</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" ><i class="fa fa-bell"></i> </a>
                <ul class="menu vertical">
                    <li>
                        <a href="#">Alert Name <span class="label default">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label primary">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">View All</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-user"></i> {{$user->first_name}}</a>
                <ul class="menu vertical">
                    <li><a href="#"><i class="fa fa-fw fa-user"></i> Profile</a></li>
                    <li><a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a></li>
                    <li><a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a></li>
                    <li><a href="/sc-panel/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
