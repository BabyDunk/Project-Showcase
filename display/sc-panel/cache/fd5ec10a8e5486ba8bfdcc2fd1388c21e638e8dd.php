<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 27/05/2018
	 * Time: 13:22
	 */

	$user = \Classes\Core\User::find_by_id($userid);

	?>


<!-- Sidebar -->
<div class="off-canvas position-left reveal-for-large nav" id="offCanvas" data-off-canvas>

    <h3> Welcome Admin </h3>

    <div class="image-holder text-center">
        <img src="<?php echo e($user->image_path_placeholder()); ?>" alt="<?php echo e($user->first_name); ?>" title="Admin" >

        <p><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></p>
    </div>
    <ul class="vertical menu">
        <li>
            <a href="/sc-panel"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <?php if(!empty($user->privilege)): ?>
        <li>
            <a href="/sc-panel/users"><i class="fa fa-fw fa-users"></i> Users</a>
        </li>
        <?php endif; ?>
        <li>
            <a href="/sc-panel/uploads"><i class="fa fa-fw fa-table"></i> Upload</a>
        </li>
        <li>
            <a href="/sc-panel/showcase"><i class="fa fa-fw fa-table"></i> Showcases</a>
        </li>
        <li>
            <a href="/sc-panel/comments"><i class="fa fa-fw fa-edit"></i> Comments</a>
        </li>
        <?php if(!empty($user->privilege)): ?>
        <li>
            <a href="/sc-panel/statistics"><i class="fa fa-fw fa-bar-chart-o"></i> Statistics</a>
        </li>
        <li>
            <ul class="vertical menu" data-accordion-menu>
                <li>
                    <a href="#"><i class="fa fa-fw fa-wrench"></i> Settings</a>
                    <ul class="menu vertical nested">
                        <li><a href="/sc-panel/general_settings"><i class="fa fa-arrow-circle-right"></i> General</a></li>
                        <li><a href="/sc-panel/email_settings"><i class="fa fa-envelope"></i> Email</a></li>
                        <li><a href="/sc-panel/social_settings"><i class="fa fa-share-square" aria-hidden="true"></i> Social</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <?php endif; ?>
    </ul>

</div>
