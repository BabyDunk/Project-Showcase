<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 28/05/2018
	 * Time: 01:43
	 */

$users =  \Classes\Core\User::find_all();

?>



<?php $__env->startSection('title', 'Users'); ?>

<?php $__env->startSection('page-id', 'users'); ?>

<?php $__env->startSection('content'); ?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Users
                    <small><a href="/sc-panel/adduser" > Add User</a></small>
                </h1>
                <?php if(isset($message)): ?>
                    <h2 class="bg-info">
                        <?php echo e($message); ?>

                    </h2>
                <?php endif; ?>
                <?php if(\Classes\Core\Session::has('MESSAGE')): ?>
                    <h2 class="bg-info">
                        <?php echo e(\Classes\Core\Session::get('MESSAGE')); ?>

                    </h2>
                <?php endif; ?>
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
                            <td><h3><?php echo e($user->id); ?></h3></td>
                            <td><img class="img-responsive user-image" src="<?php echo $user->image_path_placeholder(); ?>" /></td>
                            <td><p><?php echo e($user->username); ?></p>
                                <div class="action_link">

                                    <a href="/sc-panel/updateuser/<?php echo e($user->id); ?>">Edit</a>
                                    <a href="/sc-panel/users/<?php echo e($user->id); ?>">Delete</a>

                                </div>
                            </td>
                            <td><p><?php echo e($user->first_name); ?></p></td>
                            <td><p><?php echo e($user->last_name); ?></p></td>
                            <td><p><a href="mailto:<?php echo e($user->email); ?>"><?php echo e($user->email); ?></a></p></td>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('extends.admin-base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>