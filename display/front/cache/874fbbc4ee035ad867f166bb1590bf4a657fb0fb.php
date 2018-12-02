<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 20/06/2018
	 * Time: 20:59
	 *
	 **/

	$showcase = \Classes\Core\Showcase::find_by_id($id);

	$showcaseUser = \Classes\Core\User::find_by_id($showcase->user_id);

	$showcasePins = \Classes\Core\ShowcasePins::find_by_show_id($showcase->show_id);

	$isLogin = (\Classes\Core\Session::instance()->is_signed_in()) ?  \Classes\Core\Session::instance()->user_id : '';

    $comments =   \Classes\Core\Comment::find_comments($showcase->id);

/*echo "<pre>";
print_r($showcasePins);
echo "</pre>";exit;*/
	 ?>



<?php $__env->startSection('title', $showcase->title); ?>

<?php $__env->startSection('page-id', 'showcased'); ?>

<?php $__env->startSection('content'); ?>

    <div class="grid-container">
        <div id="info-top">
            <div class="grid-x grid-padding-x" data-equalizer data-equalize-on="medium" >
                <div class="medium-8">
                    <div class="card " data-equalizer-watch>

                        <img class="thumbnail" src="<?php echo e($showcase->get_picture()); ?>" />

                        <div class="card-section">

                            <ul>
                                <?php if(!empty($showcase->front_demo_link)): ?>
                                    <li><a href="<?php echo e($showcase->front_demo_link); ?>">Frontend Demo</a> </li>
                                <?php endif; ?>
                                <?php if(!empty($showcase->back_demo_link)): ?>
                                    <li><a href="<?php echo e($showcase->back_demo_link); ?>">Backend Demo</a> <?php if(!empty($showcase->back_demo_user) && !empty($showcase->back_demo_pass)): ?><small>Username: <?php echo e($showcase->back_demo_user); ?> - Password: <?php echo e($showcase->back_demo_pass); ?></small><?php endif; ?></li>
                                <?php endif; ?>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="medium-4">
                    <div class="card" data-equalizer-watch>
                        <div class="card-divider">
                            <h4 class="h4">Information</h4>
                        </div>
                        <div class="card-section">
                            <fieldset class="fieldset">
                                <legend>Showcase</legend>
                                <ul>
                                    <li><strong>Title: </strong><?php echo e($showcase->title); ?></li>
                                    <li><strong>Subtitle: </strong><?php echo e($showcase->subtitle); ?></li>
                                    <li><strong>Designer: </strong><?php echo e($showcaseUser->first_name); ?> <?php echo e($showcaseUser->last_name); ?></li>
                                </ul>
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend>Job</legend>
                                <ul>
                                    <li><strong>Duration: </strong> <?php echo !empty($showcase->job_duration) ? $showcase->job_duration . ' Days' : 'Contact designer' ?></li>
                                    <li><strong>Deposit: </strong> <?php echo !empty($showcase->job_deposit) ? '&pound;' . $showcase->job_deposit : 'No deposit required' ?></li>
                                    <li><strong>Payment Method: </strong>
                                        <?php if(!empty($showcase->showcasePayment)): ?>
                                            <?php echo implode(', ', unserialize($showcase->showcasePayment))?>
                                            <?php else: ?>
                                            No payment options selected
                                        <?php endif; ?></li>
                                </ul>
                            </fieldset>

                            <?php if($isLogin === $showcase->user_id): ?>
                                <ul class="showcase-panel">
                                    <li><span><a href="/admin/uploads/<?php echo e($id); ?>">Edit</a></span></li> |
                                    <li><span><a href="/admin/showcase/<?php echo e($id); ?>">Delete</a></span></li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $__env->make('includes.showcase-notice-blocks', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


        <div class="grid-x grid-padding-x">
            <div id="threaded-info">

                <?php if(!empty($showcasePins)): ?>
                    <div class="thread-tab-center">
                    </div>


                <?php $i = 0; ?>
                <?php $__currentLoopData = $showcasePins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($i % 2 != 0): ?>
                        <div class="thread-tab-left">
                            <div class="card">
                                <div class="thread-pin">
                                    <i class="fa fa-info-circle fa-2x"></i>
                                </div>
                                <div class="callout">
                                    <h4 class="h4"><?php echo e($item->show_title); ?></h4>
                                    <p> <?php echo allowedTags($item->show_body); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if($i % 2 == 0): ?>
                        <div class="thread-tab-right">
                            <div class="card">
                                <div class="thread-pin">
                                    <i class="fa fa-info-circle fa-2x"></i>
                                </div>

                                <div class="callout">
                                    <h4 class="h4"><?php echo e($item->show_title); ?></h4>
                                    <p> <?php echo allowedTags($item->show_body); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php $i++; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>


        <?php echo $__env->make('includes.comments', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('extends.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>