<?php
	/**
 * Created by Chris Wilkinson.
 * Title: oop
 * Date: 28/05/2018
 * Time: 02:03
 */


	$showcases = \Classes\Core\Showcase::find_by_user_id(\Classes\Core\Session::instance()->user_id);


	$comments = [];
	if ( ! empty( $showcases ) ) {
		foreach ( $showcases as $showcase ) {
			$theData = \Classes\Core\Comment::find_by_show_id( $showcase->id );

			if ( ! empty( $theData ) ) {
				$comments = array_merge( $comments , $theData );
			}
		}
	}

    $comments = (object)$comments;

?>



<?php $__env->startSection('title', 'Comments'); ?>

<?php $__env->startSection('page-id', 'comments'); ?>

<?php $__env->startSection('content'); ?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Comments
                    <small>All User Comments</small>
                </h1>
                <div class="col-md-12">
                    <table class="hover unstriped stack">
                        <thead>
                        <tr>
                            <th class="col-md-1">ID</th>
                            <th class="col-md-2">Showcase</th>
                            <th class="col-md-3">Author</th>
                            <th class="col-md-3">Comment</th>
                            <th class="col-md-3">Comment Date</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php $showcase  =   \Classes\Core\Showcase::find_by_id($comment->show_id) ?>
                        <tr>
                            <td class="col-md-1"><h3><?php echo e($comment->show_id); ?></h3></td>
                            <td class="col-md-2"><img style="width:100%; max-width:200px;" class="thumbnail" src="<?php echo e($showcase->get_picture()); ?>" /></td>
                            <td class="col-md-3"><p><?php echo e($comment->author); ?></p>
                                <div class="action_link">

                                    <a href="/sc-panel/comments/<?php echo e($comment->id); ?>/delete">Delete</a>

                                </div>
                            </td>
                            <td class="col-md-3"><p><?php echo e($comment->body); ?></p></td>
                            <td class="col-md-3"><p><?php echo date( "D j M Y g:i A", strtotime($comment->created_at)); ?></p></td>
                        </tr>

						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


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