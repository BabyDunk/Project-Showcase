<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 28/05/2018
	 * Time: 01:51
	 */

$showcases =  \Classes\Core\Showcase::find_by_user_id(\Classes\Core\Session::instance()->user_id);

//var_dump($showcases); exit;


?>



<?php $__env->startSection('title', 'Showcase'); ?>

<?php $__env->startSection('page-id', 'showcase'); ?>

<?php $__env->startSection('content'); ?>


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Showcases
                    <small><a href="/sc-panel/uploads" >Upload New Showcase</a></small>
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
                            <th class="col-md-2">Showcase</th>
                            <th class="col-md-2">Title</th>
                            <th class="col-md-4">Description</th>
                            <th class="col-md-1">Payment Method</th>
                            <th class="col-md-1">Deposit</th>
                            <th class="col-md-1">Id</th>
                            <th class="col-md-1">Comments</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($showcases)): ?>
						<?php $__currentLoopData = $showcases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $showcase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

						<?php


                        $comcounts   = \Classes\Core\Comment::find_comments($showcase->id);

						$comcount   =   count($comcounts);

						if($comcount == 1){

							$count= $comcount . ' Comment';

						} else if($comcount > 1 ) {


							$count = $comcount . ' Comments';

						} else {

							$count = 'No comments';

						}

						$comment_link   = ($comcount > 0 ) ?  '<a href="/sc-panel/comment_showcase/' . $showcase->id . '">View Comments</a>' : '';

						?>
                        <tr>
                            <td class="col-md-2"><a href="/sc-panel/showcase/<?php echo e($showcase->id); ?>" class="thumbnail"> <img class="img-responsive" src="<?php echo $showcase->get_picture(); ?>" /></a>
                                <ul style="list-style-type: none; padding-left:0;margin-left:0;">
                                    <li style="padding:3px; border:1px solid #ccc;border-radius:3px; background-color: <?php echo $showcase->bg_colorselector; ?>;">Background color</li>
                                    <li style="padding:3px; border:1px solid #ccc;border-radius:3px; background-color: <?php echo $showcase->fg_colorselector; ?>;">Foreground Color</li>
                                </ul>

                                <div class="pictures_link">
                                    <a href="/showcase/<?php echo e($showcase->id); ?>/<?php echo e(urlString($showcase->title)); ?>">View</a>
                                    <a href="/sc-panel/uploads/<?php echo e($showcase->id); ?>">Edit</a>
                                    <a href="/sc-panel/showcase/<?php echo e($showcase->id); ?>">Delete</a>

                                </div>
                            </td>
                            <td class="col-md-2"><h3><?php echo e($showcase->title); ?></h3><h5><?php echo e($showcase->subtitle); ?></h5></td>
                            <td class="col-md-4"><p><?php echo allowedTags($showcase->description1); ?></p></td>
                            <td class="col-md-1"><p><?php echo e((!empty($showcase->showcasePayment)) ? implode(', ', unserialize($showcase->showcasePayment)) : 'No payment method selected'); ?></p></td>
                            <td class="col-md-1"><p><?php echo (!empty($showcase->job_deposit)) ? '&pound;'.$showcase->job_deposit : 'No deposit set'; ?></p></td>
                            <td class="col-md-1"><p><?php echo e($showcase->id); ?></p></td>
                            <td class="col-md-1 comment-list">
                                <ul>
                                    <li><?php echo e($count); ?></li>
                                    <li><?php echo $comment_link; ?></li>

                                </ul>

                            </td>
                        </tr>

						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>


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