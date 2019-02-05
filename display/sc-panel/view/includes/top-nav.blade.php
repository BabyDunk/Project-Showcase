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
	$commentCounter = 0;

	if ( ! empty( $showcases ) )
	{
		foreach ( $showcases as $item )
		{

			$comment = (array)\Classes\Core\Comment::find_by_show_id( $item->id);

			if(!empty($comment[0]) && $commentCounter <= 5){
				$commentCounter++;
			    $comments = array_merge( $comments , $comment );
			}
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
                            <small class="small text-muted"><i class="fa fa-clock-o"></i> @php
                                    $date = new DateTime($comment->created_at);
                                    echo $date->format('l jS \of F Y h:i:s A');
                                @endphp </small>
                            <div class="media-card">
                                <div class="media-body-title">
                                    <span class="pull-left">
                                        <div class="comment-media-object"  data-author="{{$comment->author}}"></div>
                                    </span>
                                    <div class="media-card-title">
                                        <h5>
                                            <strong>{{$comment->author}}</strong>
                                        </h5>
                                    </div>
                                </div>
                                <div class="media-card-body">
                                    <p>@if(strlen($comment->body) > 100)

                                           {{substr($comment->body, 0, 100)}}...

                                           @else

                                           {{$comment->body}}

                                    @endif</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endforeach
                    <li class="message-footer">
                        <a href="/sc-panel/comments">Read All Comments</a>
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
                    <li><a href="/sc-panel/updateuser/{{\Classes\Core\Session::instance()->user_id}}"><i class="fa fa-fw fa-gear"></i> Settings</a></li>
                    <li><a href="/sc-panel/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
