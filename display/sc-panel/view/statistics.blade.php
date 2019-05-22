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
                    Statistics
                    <small>Site performance</small>
                </h1>
                @include('includes.messages')
                <div class="col-md-12">
                    <table class="hover unstriped stack">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Showcase</th>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php foreach ( $users as $user ) : ?>
                        <tr>
                            <td><h3><?php echo $user->id; ?></h3></td>
                            <td><img class="img-responsive user-image" src="<?php echo $user->get_picture(); ?>" /></td>
                            <td><p><?php echo $user->username; ?></p>
                                <div class="action_link">

                                    <a href="/sc-panel/updateuser/<?php echo $user->id; ?>">Edit</a>
                                    <a href="/sc-panel/deleteusers/<?php echo $user->id; ?>">Delete</a>

                                </div>
                            </td>
                            <td><p><?php echo $user->first_name; ?></p></td>
                            <td><p><?php echo $user->last_name; ?></p></td>
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