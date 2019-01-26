<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 28/05/2018
	 * Time: 01:59
	 */


	?>



<?php $__env->startSection('title', 'Email Settings'); ?>

<?php $__env->startSection('page-id', 'settings'); ?>

<?php $__env->startSection('content'); ?>
    <div id="page-wrapper">


            <!-- Page Heading -->
            <div class="grid-x">
                <div class="large-12">
                    <h1 class="page-header">
                        Settings
                        <small>Email Settings</small>
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
                    <h2 class="bg-warning">
                        <?php if(isset($error)): ?>
                            <?php $__currentLoopData = $error; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($err); ?><br>;
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </h2>

                    <form method="POST" action="/sc-panel/email_settings" enctype="multipart/form-data">
                        <input type="hidden" name="CSRFToken" value="<?php echo \Classes\Core\CSRFToken::_SetToken(); ?>"/>
                        <input type="hidden" name="emailauth" value="0">
                        <div class="grid-container full">
                            <div class="grid-x grid-padding-x">
                                <div class="medium-6 cell">
                                    <fieldset class="fieldset">
                                        <legend>Email Server Settings</legend>
                                        <label for="emailtitle">Title To Appear On Email</label>
                                        <input class="form-control" type="text" name="emailtitle" id="emailtitle" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_emailtitle'))) ? sca_get_preference('showcase', 'sca_emailtitle') : ''; ?>" placeholder="Title to display on email" />

                                        <label for="emailname">Name Too Appear On Email</label>
                                        <input class="form-control" type="text" name="emailname" id="emailname" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_emailname'))) ? sca_get_preference('showcase', 'sca_emailname') : ''; ?>" placeholder="Name to display on email" />

                                        <label for="emailserver">Email Server Name</label>
                                        <input class="form-control" type="text" name="emailserver" id="emailserver" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_emailserver'))) ? sca_get_preference('showcase', 'sca_emailserver') : ''; ?>" placeholder="Email server address eg; smtp.google.com" />

                                        <label for="emailgateway">Email Gateway Address</label>
                                        <input class="form-control" type="email" name="emailgateway" id="emailgateway" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_emailgateway'))) ? sca_get_preference('showcase', 'sca_emailgateway') : ''; ?>" placeholder="Email address to use for sending websites notifications" />

                                        <label for="emailgatewaypass">Email Gateway Password</label>
                                        <input class="form-control" type="password" name="emailgatewaypass" id="emailgatewaypass" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_emailgatewaypass'))) ? sca_get_preference('showcase', 'sca_emailgatewaypass') : ''; ?>" placeholder="Password email gateway" />

                                        <label for="emailserverport">Server Port<small><em> eg; 993</em></small></label>
                                        <input class="form-control" type="text" name="emailserverport" id="emailserverport" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_emailserverport'))) ? sca_get_preference('showcase', 'sca_emailserverport') : ''; ?>" placeholder="Server port number" />

                                        <label for="emailencryption">Encryption Type <small><em> eg; Leave blank, tls, ssl</em></small></label>
                                        <input class="form-control" type="text" name="emailencryption" id="emailencryption" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_emailencryption'))) ? sca_get_preference('showcase', 'sca_emailencryption') : ''; ?>" placeholder="Email encryption type" />

                                        <fieldset class="fieldset">
                                            <legend>Enable SMTP Authentication</legend>

                                            <div class="switch">
                                                <input class="switch-input" type="checkbox" name="emailauth" id="emailauth" value="1" <?php echo (!empty(sca_get_preference('showcase', 'sca_emailauth'))) ? 'checked' : ''; ?>/>
                                                <label class="switch-paddle" for="emailauth">
                                                    <span class="show-for-sr">Enable SMTP Authentication</span>
                                                    <span class="switch-active" aria-hidden="true">Yes</span>
                                                    <span class="switch-inactive" aria-hidden="true">No</span>
                                                </label>
                                            </div>

                                        </fieldset>

                                        <label for="emailsignature">Email Signature</label>
                                        <textarea class="form-control" name="emailsignature" id="emailsignature" placeholder="Describe in short what we do here" ><?php echo (!empty(sca_get_preference('showcase', 'sca_emailsignature'))) ? sca_get_preference('showcase', 'sca_emailsignature') : ''; ?></textarea>
                                    </fieldset>
                                    <button  class="success button expanded" type="submit" name="submit" id="submit" value="true" >Submit!</button>
                                </div>
                            </div>
                        </div>
                    </form>



                </div>
            </div>
            <!-- /.grid-x -->


    </div>
    <!-- /#page-wrapper -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('extends.admin-base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>