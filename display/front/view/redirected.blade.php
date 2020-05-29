<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 02/05/2019
	 * Time: 22:05
	 */


?>

@extends('extends.base')

@section('title',  'Redirected')

@section('page-id', 'redirected')

@section('content')
	<!-- Navigation -->
	@include('includes.shop-navi')
    <main>
        @include('includes.messages')
    </main>
    <!-- /.row -->

@endsection
