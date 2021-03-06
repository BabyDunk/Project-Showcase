<?php
/**
 * Created by Chris Wilkinson.
 * Title: showcase_app
 * Date: 20/06/2018
 * Time: 20:59
 *
 **/

$showcase = \Classes\Core\Showcase::find_by_id( $id[ 'id' ] );

$showcaseUser = \Classes\Core\User::find_by_id( $showcase->user_id );

$showcasePins = \Classes\Core\ShowcasePins::find_by_show_id( $showcase->show_id );

$isLogin = ( \Classes\Core\Session::instance()->is_signed_in() ) ? \Classes\Core\Session::instance()->user_id : '';

$comments = \Classes\Core\Comment::find_comments( $showcase->id );


?>

@extends('extends.base')

@section('title', $showcase->title)

@section('page-id', 'showcased')

@section('content')
    <!-- Navigation -->
    @include('includes.shop-navi')

    <main>
        <div id="info-top">
            <div class="container" data-equalizer data-equalize-on="medium">
                <div class="split-12">
                    <div class="card " data-equalizer-watch>

                        <img class="thumbnail" src="{{$showcase->get_picture()}}" alt="{{$showcase->title}}"/>

                        <div class="card-section">

                        </div>
                    </div>
                </div>
                <div class="split-12">
                    <div class="card" data-equalizer-watch>
                        <div class="card-divider">
                            <h4 class="h3">Information</h4>
                        </div>
                        <div class="info-section">
                            <fieldset class="fieldset">
                                <legend>Tool Box</legend>
                                <ul class="showcase-panel">
                                    @if($isLogin === $showcase->user_id)

                                        <li><span><a href="/sc-panel/uploads/{{$id['id']}}">Edit</a></span></li>
                                        |
                                        <li><span><a href="/sc-panel/showcase/{{$id['id']}}/delete">Delete</a></span>
                                        </li>
                                        |
                                    @endif
                                    <li><a href="#contact_showcase_author" class="button success" data-smooth-scroll>Contact
                                            Dev</a></li>
                                </ul>

                                @if(!empty($showcase->front_demo_link) || !empty($showcase->back_demo_link))
                                    <fieldset class="fieldset">
                                        <legend>Demo Credentials</legend>
                                        <ul>
                                            @if(!empty($showcase->front_demo_link))
                                                <li><a href="{{$showcase->front_demo_link}}">Frontend Demo</a></li>
                                            @endif
                                            @if(!empty($showcase->back_demo_link))
                                                <li><a href="{{$showcase->back_demo_link}}">Backend
                                                        Demo</a> @if(!empty($showcase->back_demo_user) && !empty($showcase->back_demo_pass))
                                                        <small>Username: {{$showcase->back_demo_user}} -
                                                            Password: {{$showcase->back_demo_pass}}</small>@endif</li>
                                            @endif
                                        </ul>
                                    </fieldset>
                                @endif

                            </fieldset>

                            <fieldset class="fieldset">
                                <legend>Showcase</legend>
                                <ul>
                                    <li><strong>Title: </strong>{{$showcase->title}}</li>
                                    <li><strong>Subtitle: </strong>{{$showcase->subtitle}}</li>
                                    <li>
                                        <strong>Developer: </strong>{{$showcaseUser->first_name}} {{$showcaseUser->last_name}}
                                    </li>
                                </ul>
                            </fieldset>

                            @if(empty($showcase->price))
                                <fieldset class="fieldset">
                                    <legend>Job</legend>
                                    <ul>
                                        <li>
                                            <strong>Duration: </strong> @php echo !empty($showcase->job_duration) ? $showcase->job_duration . ' Days' : 'Contact designer' @endphp
                                        </li>
                                        <li>
                                            <strong>Deposit: </strong> @php echo !empty($showcase->job_deposit) ? '&pound;' . $showcase->job_deposit : 'No deposit required' @endphp
                                        </li>
                                        <li><strong>Payment Method: </strong>
                                            @if(!empty($showcase->showcasePayment))
                                                @php echo implode(', ', unserialize($showcase->showcasePayment))@endphp
                                            @else
                                                No payment options offered
                                            @endif</li>
                                    </ul>
                                </fieldset>
                            @endif
                            @php \Classes\Core\ShoppingCart::echoAddButton() @endphp
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('includes.showcase-notice-blocks')


        <div id="threaded-info">
            <div class="container">
                @if(!empty($showcasePins))
                    <div class="thread-tab-center">
                    </div>


                    @php $i = 0; @endphp
                    @foreach($showcasePins as $item)
                        @if($i % 2 != 0)
                            <div class="thread-tab-left">
                                <div class="card">
                                    <div class="thread-pin">
                                        <i class="fa fa-info-circle fa-2x"></i>
                                    </div>
                                    <div class="cell">
                                        <h4 class="h4">{{$item->show_title}}</h4>
                                        <p> <?php echo allowedTags( $item->show_body ); ?></p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($i % 2 == 0)
                            <div class="thread-tab-right">
                                <div class="card">
                                    <div class="thread-pin">
                                        <i class="fa fa-info-circle fa-2x"></i>
                                    </div>

                                    <div class="cell">
                                        <h4 class="h4">{{$item->show_title}}</h4>
                                        <p> <?php echo allowedTags( $item->show_body ); ?></p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @php $i++; @endphp
                    @endforeach
                @endif
            </div>
        </div>

        <div class="container">
            <hr/>
        </div>


        @include('includes.comments')


        <div id="contact_showcase_author" class="clearfix">
            <div class="container">
                <div id="contact-dev">
                    @php
                        \Classes\Core\Contact::echo_form();
                    @endphp
                </div>
            </div>
        </div>
    </main>
@endsection