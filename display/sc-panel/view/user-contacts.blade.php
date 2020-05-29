<?php
	/**
 * Created by Chris Wilkinson.
 * Title: oop
 * Date: 28/05/2018
 * Time: 02:03
 */


    $contacts = \Classes\Core\Contact::find_by_user_id(\Classes\Core\Session::instance()->user_id);




?>

@extends('extends.admin-base')

@section('title', 'Contacts')

@section('page-id', 'contacts')

@section('content')

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Contacts
                    <small>{{\Classes\Core\User::hasPrivilege() ? 'All User' : 'Your'}} Contacts</small>
                </h1>
                @include('includes.messages')
                <div class="col-md-12">
                    <table class="hover unstriped stack">
                        <thead>
                        <tr>
                            <th class="col-md-1">ID</th>
                            <th class="col-md-3">Author</th>
                            <th class="col-md-3">Comment</th>
                            <th class="col-md-3">Comment Date</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if($contacts)
                            @foreach ($contacts  as $contact )

                            <tr>
                                <td class="col-md-1"><h3>{{$contact->id}}</h3></td>
                                <td class="col-md-3">
                                    <p>{{$contact->name}}</p>
                                    <p><a href="mailto:{{$contact->email}}">{{$contact->email}}</a></p>
                                    @if($contact->phone)
                                        <p><a href="tel:{{$contact->phone}}">{{$contact->phone}}</a> </p>
                                    @endif
                                    <div class="action_link">

                                        <a href="/sc-panel/user_contacts/{{$contact->id}}/delete">Delete</a>

                                    </div>
                                </td>
                                <td class="col-md-3"><p>{{$contact->message}}</p></td>
                                <td class="col-md-3"><p>@php echo date( "D j M Y g:i A", strtotime($contact->created_at)); @endphp</p></td>
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