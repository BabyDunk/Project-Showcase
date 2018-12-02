<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 26/05/2018
	 * Time: 10:18
	 */?>



<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('page-id', 'home'); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
<?php echo $__env->make('includes.feature-slider', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('includes.info-1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('includes.text-slider', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('includes.featured', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('includes.contact', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


</div>
<!-- /.row -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('extends.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>