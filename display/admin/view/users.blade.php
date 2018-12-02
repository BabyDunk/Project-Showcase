<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 28/05/2018
	 * Time: 01:43
	 */

$users =  \Classes\Core\User::find_all();

?>

@extends('extends.admin-base')

@section('title', 'Users')

@section('page-id', 'users')

@section('content')
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Users
                    <small><a href="/admin/adduser" > Add User</a></small>
                </h1>
                @if(isset($message))
                    <h2 class="bg-info">
                        {{$message}}
                    </h2>
                @endif
                @if(\Classes\Core\Session::has('MESSAGE'))
                    <h2 class="bg-info">
                        {{\Classes\Core\Session::get('MESSAGE')}}
                    </h2>
                @endif
                <div class="col-md-12">
                    <table class="hover unstriped stack">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Showcase</th>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php foreach ( $users as $user ) : ?>
                        <tr>
                            <td><h3>{{$user->id}}</h3></td>
                            <td><img class="img-responsive user-image" src="<?php echo $user->image_path_placeholder(); ?>" /></td>
                            <td><p>{{$user->username}}</p>
                                <div class="action_link">

                                    <a href="/admin/updateuser/{{$user->id}}">Edit</a>
                                    <a href="/admin/users/{{$user->id}}">Delete</a>

                                </div>
                            </td>
                            <td><p>{{$user->first_name}}</p></td>
                            <td><p>{{$user->last_name}}</p></td>
                            <td><p><a href="mailto:{{$user->email}}">{{$user->email}}</a></p></td>
                        </tr>

						<?php endforeach; ?>


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