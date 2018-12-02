<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 28/05/2018
	 * Time: 13:36
	 */

	if(isset($id['id'])){
        $userData   =   \Classes\Core\User::find_by_id($id['id']);
    }
	?>

@extends('extends.admin-base')

@section('title', 'Update User')

@section('page-id', 'update-user')

@section('content')

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="grid-x grid-padding-x">
            <div class="large-12">
                <h1 class="page-header">
                    Users
                    <small>Update Details</small>
                </h1>

                <div class="grid-x grid-padding-x">
                    <div class="large-4 medium-4 cell">
                        <a href="<?php echo $userData->image_path_placeholder(); ?>" class="thumbnail"><img src="<?php echo $userData->image_path_placeholder(); ?>" alt="" class="rounded responsive"></a>
                    </div>

                    <div class="large-5 medium-5 cell">
                        <h2 class="bg-info">@if(!empty($message)){{$message}}@endif</h2>
                        <h2 class="bg-warning">
                            @if(isset($error))
                                @foreach ( $error as $err)
                                    {{$err}}<br>;
                                @endforeach
                            @endif
                        </h2>
                        <a  class="pull-right" href="/admin/users"><small>Return to user list</small></a>
                        <form method="post" action="/admin/updateuser" enctype="multipart/form-data">
                            <input type="hidden" name="CSRFToken" value="<?php echo \Classes\Core\CSRFToken::_SetToken(); ?>"/>
                            <input type="hidden" name="userId" value="<?php echo (!empty($userData->id)) ? $userData->id : ''; ?>"/>


                            <div class="grid-x">
                                <div class="large-12">
                                    <label for="user_image">User Image</label>
                                    <input type="file" class="form-control-file" id="user_image" name="user_image" >

                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="{{$userData->username}}" placeholder="Enter a username">

                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{$userData->email}}" placeholder="Enter a email">

                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value="{{$userData->password}}" placeholder="Password">

                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{$userData->first_name}}" placeholder="Enter a first name">

                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{$userData->last_name}}" placeholder="Enter a last name">

                                    <a type="submit" href="/admin/delete_user/<?php echo $sess->user_id; ?>" class="button warning float-left">Delete User</a>
                                    <button type="submit" name="update" value="true" class="button success float-right">Submit Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

@endsection

