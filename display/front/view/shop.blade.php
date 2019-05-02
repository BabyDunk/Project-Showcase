<?php
/**
 * Created by Chris Wilkinson.
 * Title: oop
 * Date: 26/05/2018
 * Time: 10:18
 */ ?>

@extends('extends.base')

@section('title', sca_get_preference('showcase', 'sca_sitename').' : Shop')

@section('page-id', 'shop')

@section('content')
    <!-- Navigation -->
    @include('includes.navigation')
    <main>
        @include('includes.feature-slider')
        @include('includes.info-1')
        @include('includes.text-slider')
        @include('includes.featured')
        @include('includes.contact')


    </main>
    <!-- /.row -->

@endsection
