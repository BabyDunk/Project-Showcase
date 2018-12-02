<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 27/05/2018
	 * Time: 13:11
	 */



	?>



<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('page-id', 'login'); ?>

<?php $__env->startSection('content'); ?>
    <div id="login">
        <div class="grid-container">
            <div class="grid-padding-x grid-x">
                <div class="medium-6 medium-offset-3 large-6 large-offset-3 cell">
                    <div class="callout loginpanel secondary clearfix">
                        <div class="text-right">
                            <a href="/admin/adduser"><h3>Register Here</h3></a>
                        </div>
                        <div class="callout clearfix primary">
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

                            <h2 class="bg-warning">
                                <?php if(isset($error)): ?>
                                    <?php $__currentLoopData = $error; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($err); ?><br>;
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </h2>

                            <form id="login-id" action="" method="post">
                                <input type="hidden" name="CSRFToken" value="<?php echo e(\Classes\Core\CSRFToken::_SetToken()); ?>"/>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter your username please" value="<?php echo (\Classes\Core\Params::has('username')) ? \Classes\Core\Params::get('post')->username : ''; ?>" >

                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password please" value="<?php echo (\Classes\Core\Params::has('password')) ? \Classes\Core\Params::get('post')->password : ''; ?>">

                                </div>


                                <div class="form-group">
                                    <button type="submit" name="submit" value="" class="button success float-right">Submit</button>

                                </div>


                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('extends.admin-min-base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>