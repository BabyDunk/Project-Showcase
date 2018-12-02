<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 18/06/2018
	 * Time: 23:54
	 */

	$featured_imgs = \Classes\Core\Showcase::find_all(sca_get_preference('showcase', 'sca_howmanyfrontfeaturedimg'), sca_get_preference('showcase', 'sca_howmanyfrontfeaturedimg'));


	?>

<div id="feature-slider">
    <!-- Page Content -->
    <div class="grid-container">
        <div class="grid-container full">
            <div class="grid-x grid-padding-x">
                <div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
                    <div class="orbit-wrapper">
                        <div class="orbit-controls">
                            <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
                            <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
                        </div>
                        <ul class="orbit-container">

                            <?php $__currentLoopData = $featured_imgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featured_img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($featured_img->filename)): ?>
                                <li class="orbit-slide">
                                    <figure class="orbit-figure">
                                        <img class="orbit-image featured-img" src="<?php echo e($featured_img->picture_url()); ?>" alt="Space">
                                        <figcaption class="orbit-caption"><a href="/showcase/<?php echo e($featured_img->id); ?>/<?php echo e(urlString($featured_img->title)); ?>"><?php echo e($featured_img->title); ?></a></figcaption>
                                    </figure>
                                </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
