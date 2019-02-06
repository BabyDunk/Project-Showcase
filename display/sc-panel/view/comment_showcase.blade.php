<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 16/07/2018
	 * Time: 19:50
	 */


    $comments =  \Classes\Core\Comment::find_comments($id['id']);
	?>



@extends('extends.admin-base')

@section('title', 'Showcase Comments')

@section('page-id', 'showcase-comments')

@section('content')


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Showcase Comment
                    <small><a href="/sc-panel/showcase" > Return to Showcases</a></small>
                </h1>
                @include('includes.messages')
                <div class="col-md-12">
                    <table class="table table-responsive table-hover">
                        <thead>
                        <tr>
                            <th class="col-md-1">ID</th>
                            <th class="col-md-2">Showcase</th>
                            <th class="col-md-3">Author</th>
                            <th class="col-md-3">Comment</th>
                            <th class="col-md-3">Comment Date</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php foreach ( $comments as $comment ) : ?>
						<?php $showcase  =   \Classes\Core\Showcase::find_by_id($comment->show_id); ?>
                        <tr>
                            <td class="col-md-1"><h3>{{$comment->show_id}}</h3></td>
                            <td class="col-md-2"><a href="/showcase/{{$showcase->id}}" class="thumbnail"><img class="img-responsive user-image" src="{{$showcase->get_picture()}}" /></a></td>
                            <td class="col-md-3"><p>{{$comment->author}}</p>
                                <div class="action_link">

                                    <a href="/sc-panel/comments/{{$comment->id}}/delete">Delete</a>

                                </div>
                            </td>
                            <td class="col-md-3"><p>{{$comment->body}}</p></td>
                            <td class="col-md-3"><p>@php $date = new DateTime($comment->created_at);                    echo $date->format('l jS \of F Y h:i:s A');@endphp</p></td>
                        </tr>

						<?php endforeach; ?>


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
