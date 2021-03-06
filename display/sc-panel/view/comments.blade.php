<?php
	/**
 * Created by Chris Wilkinson.
 * Title: oop
 * Date: 28/05/2018
 * Time: 02:03
 */

    $showcases = null;
	if (\Classes\Core\User::hasPrivilege()){
	    $showcases = \Classes\Core\Showcase::find_all();
    }else{
		$showcases = \Classes\Core\Showcase::find_by_user_id(\Classes\Core\Session::instance()->user_id);
    }

	$comments = [];
	if ( ! empty( $showcases ) ) {
		foreach ( $showcases as $showcase ) {
			$theData = \Classes\Core\Comment::find_by_show_id( $showcase->id );

			if ( ! empty( $theData ) ) {
				$comments = array_merge( $comments , $theData );
			}
		}
	}

    $comments = (object)$comments;

?>

@extends('extends.admin-base')

@section('title', 'Comments')

@section('page-id', 'comments')

@section('content')

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="grid grid-padding-x">
            <div class="large-12">
                <h1 class="page-header">
                    Comments
                    <small>{{\Classes\Core\User::hasPrivilege() ? 'All User' : 'Your'}} Comments</small>
                </h1>
                @include('includes.messages')
                <div class="medium-12">
                    <table class="hover unstriped stack">
                        <thead>
                        <tr>
                            <th class="medium-1">ID</th>
                            <th class="medium-2">Showcase</th>
                            <th class="medium-3">Author</th>
                            <th class="medium-3">Comment</th>
                            <th class="medium-3">Comment Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($comments)
                            @foreach ($comments  as $comment )
                            @php $showcase  =   \Classes\Core\Showcase::find_by_id($comment->show_id) @endphp
                            <tr>
                                <td class="medium-1"><h3>{{$comment->show_id}}</h3></td>
                                <td class="medium-2"><img style="width:100%; max-width:200px;" class="thumbnail" src="{{$showcase->get_picture()}}" /></td>
                                <td class="medium-3"><p>{{$comment->author}}</p>
                                    <div class="action_link">

                                        <a href="/sc-panel/comments/{{$contact->id}}/delete">Delete</a>

                                    </div>
                                </td>
                                <td class="medium-3"><p>{{$comment->body}}</p></td>
                                <td class="medium-3"><p>@php echo date( "D j M Y g:i A", strtotime($comment->created_at)); @endphp</p></td>
                            </tr>

                            @endforeach
                        @endif


                        </tbody>
                    </table><!-- End Of Table -->
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

@endsection