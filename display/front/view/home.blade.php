<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 26/05/2018
	 * Time: 10:18
	 */?>

@extends('extends.base')

@section('title', 'Home')

@section('page-id', 'home')

@section('content')

<div class="row">
@include('includes.feature-slider')
@include('includes.info-1')
@include('includes.text-slider')
@include('includes.featured')
@include('includes.contact')


</div>
<!-- /.row -->

@endsection
