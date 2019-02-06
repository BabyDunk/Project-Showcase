<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 27/05/2018
	 * Time: 15:46
	 */


	?>

@extends('extends.admin-min-base')

@section('title', 'Add User')

@section('page-id', 'add-user')

@section('content')
    <div id="login">
        <div class="grid-container">
            <div class="grid-padding-x grid-x">
                <div class="medium-8 medium-offset-2 large-8 large-offset-2 cell">
                    <div class="callout loginpanel secondary clearfix">
                    <h1 class="page-header">
                        Users
                        <small>Add New User</small>
                    </h1>

                    <div class="callout clearfix">
                        <h2>Register new uploader account</h2>
                        @include('includes.messages')
                        <form method="post" action="" enctype="multipart/form-data">
                            <input type="hidden" name="CSRFToken" value="<?php echo \Classes\Core\CSRFToken::_SetToken(); ?>"/>


                            <label for="user_image" class="button">User Image</label>
                            <input type="file" class="show-for-sr" id="user_image" name="user_image" >
                            <small>Add a profile image</small>

                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter a username">

                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">

                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"  placeholder="Password">

                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"  placeholder="Enter a first name">

                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter a last name">

                            <button type="submit" name="create" value="true" class="button primary float-right">Submit Registration</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    </div>
    <!-- /#page-wrapper -->
@endsection
