<?php
/**
 * Created by Chris Wilkinson.
 * Title: oop
 * Date: 28/05/2018
 * Time: 01:51
 */




?>

@extends('extends.admin-base')

@section('title', 'Showcase')

@section('page-id', 'showcase')

@section('content')


    <div id="page-wrapper">


        <!-- Page Heading -->
        <div class="grid grid-padding-x">
            <div class="large-12">
                <h1 class="page-header">
                    Showcases
                    <small><a href="/sc-panel/uploads">Upload New Showcase</a></small>
                </h1>
                @include('includes.messages')
                <div class="medium-12">
                    <table class="hover unstriped stack">
                        <thead>
                        <tr>
                            <th class="medium-2 large-2">Showcase</th>
                            <th class="medium-2 large-2">Title</th>
                            <th class="medium-4 large-4">Description</th>
                            <th class="medium-1 large-1">Payment Method</th>
                            <th class="medium-1 large-1">Fees</th>
                            <th class="medium-1 large-1">Id</th>
                            <th class="medium-1 large-1">Comments</th>
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
                                    <td class="medium-2 large-2"><a
                                                href="/shop/showcase/{{ $showcase->id}}/{{urlString($showcase->title)}}"
                                                class="thumbnail"> <img class="img-responsive" style="width:100%; max-width:200px;"
                                                                        src="<?php echo $showcase->get_picture(); ?>"/></a>
                                        <ul style="list-style-type: none; padding-left:0;margin-left:0;">
                                            <li style="padding:3px; border:1px solid #ccc;border-radius:3px; background-color: <?php echo $showcase->bg_colorselector; ?>;">
                                                Background color
                                            </li>
                                            <li style="padding:3px; border:1px solid #ccc;border-radius:3px; background-color: <?php echo $showcase->fg_colorselector; ?>;">
                                                Foreground Color
                                            </li>
                                        </ul>

                                        <div class="pictures_link">
                                            <a href="/shop/showcase/{{$showcase->id}}/{{urlString($showcase->title)}}">View</a>
                                            <a href="/sc-panel/uploads/{{ $showcase->id}}">Edit</a>
                                            <a href="/sc-panel/showcase/{{ $showcase->id}}/delete">Delete</a>

                                        </div>
                                    </td>
                                    <td class="medium-2 large-2"><h3>{{$showcase->title}}</h3>
                                        <h5>{{$showcase->subtitle}}</h5></td>
                                    <td class="medium-4 large-4">
                                        <p><?php echo allowedTags( $showcase->description1 ); ?></p></td>
                                    <td class="medium-1 large-1">
                                        <p>{{(!empty($showcase->showcasePayment)) ? implode(', ', unserialize($showcase->showcasePayment)) : 'No payment method selected'}}</p>
                                    </td>
                                    <td class="medium-1 large-1">
                                        <p><?php
                                            $feeDue = 0;
                                            if(!empty( $showcase->price ) ){
                                            	$feeDue = 'Price: '.sca_show_price($showcase->price, true);
                                            }else if(!empty($showcase->job_deposit)){
                                            	$feeDue = 'Deposit: &pound;'.$showcase->job_deposit;
                                            }else{
                                            	$feeDue = 'No fees set';
                                            }

                                            echo $feeDue  ?></p>
                                    </td>
                                    <td class="medium-1 large-1"><p>{{$showcase->id}}</p></td>
                                    <td class="medium-1 large-1 contact-list">
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
    <!-- /#page-wrapper -->

@endsection