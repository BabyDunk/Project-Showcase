<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 28/05/2018
	 * Time: 01:51
	 */

$showcases = null;
if ( \Classes\Core\User::hasPrivilege() ) {
	$showcases = \Classes\Core\Showcase::find_all();
} else {
	$showcases = \Classes\Core\Showcase::find_by_user_id( \Classes\Core\Session::instance()->user_id );
}



?>

@extends('extends.admin-base')

@section('title', 'Showcase')

@section('page-id', 'showcase')

@section('content')


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Showcases
                    <small><a href="/sc-panel/uploads" >Upload New Showcase</a></small>
                </h1>
                @include('includes.messages')
                <div class="col-md-12">
                    <table class="hover unstriped stack">
                        <thead>
                        <tr>
                            <th class="col-md-2">Showcase</th>
                            <th class="col-md-2">Title</th>
                            <th class="col-md-4">Description</th>
                            <th class="col-md-1">Payment Method</th>
                            <th class="col-md-1">Deposit</th>
                            <th class="col-md-1">Id</th>
                            <th class="col-md-1">Comments</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($showcases))
						@foreach( $showcases as $showcase )

						@php


                        $comcounts   = \Classes\Core\Comment::find_comments($showcase->id);

						$comcount   =   count($comcounts);

						if($comcount == 1){

							$count= $comcount . ' Comment';

						} else if($comcount > 1 ) {


							$count = $comcount . ' Comments';

						} else {

							$count = 'No comments';

						}

						$comment_link   = ($comcount > 0 ) ?  '<a href="/sc-panel/comment_showcase/' . $showcase->id . '">View Comments</a>' : '';

						@endphp
                        <tr>
                            <td class="col-md-2"><a href="/sc-panel/showcase/{{ $showcase->id}}" class="thumbnail"> <img class="img-responsive" src="<?php echo $showcase->get_picture(); ?>" /></a>
                                <ul style="list-style-type: none; padding-left:0;margin-left:0;">
                                    <li style="padding:3px; border:1px solid #ccc;border-radius:3px; background-color: <?php echo $showcase->bg_colorselector; ?>;">Background color</li>
                                    <li style="padding:3px; border:1px solid #ccc;border-radius:3px; background-color: <?php echo $showcase->fg_colorselector; ?>;">Foreground Color</li>
                                </ul>

                                <div class="pictures_link">
                                    <a href="/showcase/{{$showcase->id}}/{{urlString($showcase->title)}}">View</a>
                                    <a href="/sc-panel/uploads/{{ $showcase->id}}">Edit</a>
                                    <a href="/sc-panel/showcase/{{ $showcase->id}}">Delete</a>

                                </div>
                            </td>
                            <td class="col-md-2"><h3>{{$showcase->title}}</h3><h5>{{$showcase->subtitle}}</h5></td>
                            <td class="col-md-4"><p><?php echo allowedTags($showcase->description1); ?></p></td>
                            <td class="col-md-1"><p>{{(!empty($showcase->showcasePayment)) ? implode(', ', unserialize($showcase->showcasePayment)) : 'No payment method selected'}}</p></td>
                            <td class="col-md-1"><p><?php echo (!empty($showcase->job_deposit)) ? '&pound;'.$showcase->job_deposit : 'No deposit set'; ?></p></td>
                            <td class="col-md-1"><p>{{$showcase->id}}</p></td>
                            <td class="col-md-1 contact-list">
                                <ul>
                                    <li>{{$count}}</li>
                                    <li>@php echo $comment_link; @endphp</li>

                                </ul>

                            </td>
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