<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 28/05/2018
	 * Time: 13:36
	 */
var_dump(\Classes\Core\Session::get('checkHash'));
	if(isset($id['id'])){
        $userData   =   \Classes\Core\User::find_by_id($id['id']);
    }
	?>



<?php $__env->startSection('title', 'Update User'); ?>

<?php $__env->startSection('page-id', 'update-user'); ?>

<?php $__env->startSection('content'); ?>

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
                        <h2 class="bg-info"><?php if(!empty($message)): ?><?php echo e($message); ?><?php endif; ?></h2>
                        <h2 class="bg-warning">
                            <?php if(isset($error)): ?>
                                <?php $__currentLoopData = $error; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($err); ?><br>;
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
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
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo e($userData->username); ?>" placeholder="Enter a username">

                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?php echo e($userData->email); ?>" placeholder="Enter a email">

                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value="<?php echo e($userData->password); ?>" placeholder="Password">

                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo e($userData->first_name); ?>" placeholder="Enter a first name">

                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo e($userData->last_name); ?>" placeholder="Enter a last name">

                                    <fieldset>
                                        <legend>Administration Privilege</legend>

                                        <div class="switch">
                                            <input class="switch-input" id="privilege1" type="radio" value="0" <?php echo ((int)$userData->privilege === 0) ? 'checked' : ''; ?>  name="privilege">
                                            <label class="switch-paddle" for="privilege1">
                                                <span class="show-for-sr">Non-privileged</span>
                                                <span class="switch-active" aria-hidden="true">Normal</span>
                                                <span class="switch-inactive" aria-hidden="true"></span>
                                            </label>
                                        </div>
                                        <div class="switch">
                                            <input class="switch-input" id="privilege2" type="radio" value="1"  <?php echo ((int)$userData->privilege === 1) ? 'checked' : ''; ?>  name="privilege">
                                            <label class="switch-paddle" for="privilege2">
                                                <span class="show-for-sr">Privileged</span>
                                                <span class="switch-active" aria-hidden="true">Privileged</span>
                                                <span class="switch-inactive" aria-hidden="true"></span>
                                            </label>
                                        </div>
                                    </fieldset>

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

<?php $__env->stopSection(); ?>


<?php echo $__env->make('extends.admin-base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>