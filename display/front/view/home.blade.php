<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 20/06/2018
	 * Time: 20:58
	 */


	?>

@extends('extends.base')

@section('title', 'Home')

@section('page-id', 'home')

@section('content')


	<div id="home-first-view" class="home-views">
		<h1>Welcome to {{sca_get_preference('showcase', 'sca_sitename')}}</h1>
	</div>

	<div id="home-second-view" class="home-views">
		<h1>Something About You</h1>
	</div>

	<div id="home-third-view" class="home-views">
		<h1>Something About Skills</h1>
	</div>

	<div id="home-fourth-view" class="home-views">
		<h1>Something About Projects</h1>
	</div>


    <!-- /.row -->

@endsection
