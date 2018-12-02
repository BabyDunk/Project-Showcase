<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 17/06/2018
	 * Time: 03:00
	 */


	$showcases = \Classes\Core\Showcase::find_all(sca_get_preference('showcase', 'sca_howmanyfrontfeatured'), sca_get_preference('showcase', 'sca_whichorderfeatured'));


$i = 0;
	?>

<?php $__currentLoopData = $showcases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $showcase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php
		$i++;
		$urlfriedlytitle = urlString($showcase->title);
	?>
<div class="featured" style="background-color: <?php echo e($showcase->bg_colorselector); ?>;">
    <div class="inner-featured">
        <div class="grid-container">
				<div class="grid-x grid-padding-x">
					<?php if($i % 2 != 0): ?>
						<div class="medium-3 cell">
							<div class="image-featured">
								<img class="thumbnail" src="<?php echo e($showcase->get_picture()); ?>"/>
							</div>
							<ul>
								<li><a href="/showcase/<?php echo e($showcase->id); ?>/<?php echo e($urlfriedlytitle); ?>" >View</a></li>
								<li><a href="/showcase/<?php echo e($showcase->id); ?>/<?php echo e($urlfriedlytitle); ?>" >View</a></li>
								<li><a href="/showcase/<?php echo e($showcase->id); ?>/<?php echo e($urlfriedlytitle); ?>" >View</a></li>
							</ul>
						</div>
						<div class="medium-9 callout">
							<h3><?php echo e($showcase->title); ?></h3>
							<h4><?php echo e($showcase->subtitle); ?></h4>
							<p><?php echo allowedTags($showcase->description1); ?> </p>
						</div>
					<?php else: ?>
						<div class="medium-9 cell" >
							<h3><?php echo e($showcase->title); ?></h3>
							<h4><?php echo e($showcase->subtitle); ?></h4>
							<p><?php echo allowedTags($showcase->description1); ?> </p>
						</div>
						<div class="medium-3 cell">
							<div class="image-featured">
								<img class="thumbnail" src="<?php echo e($showcase->get_picture()); ?>"/>
							</div>
							<ul>
								<li><a href="/showcase/<?php echo e($showcase->id); ?>/<?php echo e($urlfriedlytitle); ?>" >View</a></li>
								<li><a href="/showcase/<?php echo e($showcase->id); ?>/<?php echo e($urlfriedlytitle); ?>" >View</a></li>
								<li><a href="/showcase/<?php echo e($showcase->id); ?>/<?php echo e($urlfriedlytitle); ?>" >View</a></li>
							</ul>
						</div>
					<?php endif; ?>
				</div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
