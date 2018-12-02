<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 22/06/2018
	 * Time: 13:19
	 */

	$theeBlockNotice = (object)unserialize(\Classes\Core\Showcase::find_by_id($id)->three_notice_block);

	//var_dump($theeBlockNotice);

	?>

<?php if(!isset($theeBlockNotice->scalar)): ?>
<div id="info-1">
    <!-- Page Content -->
    <div class="grid-container">
        <div class="grid-container">
            <div class="grid-x grid-padding-x">
                <div class="grid-x grid-margin-x text-center" data-equalizer data-equalize-on="medium" id="test-eq">
                    <div class="cell medium-4">
                        <div class="card" data-equalizer-watch>
                            <div class="card-divider">
                                <h4 class="h4"><?php echo e($theeBlockNotice->blocknoticetitle1); ?></h4>
                            </div>
                            <div class="card-image">
                                <i style="color: <?php echo e($theeBlockNotice->blocknotice_colorselector1); ?>" class="fa fa-5x <?php echo e($theeBlockNotice->blocknoticefaicon1); ?> text-center"></i>
                            </div>
                            <div class="card-section">
                                <h4><?php echo e($theeBlockNotice->blocknoticesubtitle1); ?></h4>
                                <p><?php echo allowedTags($theeBlockNotice->blocknoticedescrip1); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="cell medium-4">
                        <div class="card" data-equalizer-watch>
                            <div class="card-divider">
                                <h4 class="h4"><?php echo e($theeBlockNotice->blocknoticetitle2); ?></h4>
                            </div>
                            <div class="card-image">
                                <i style="color: <?php echo e($theeBlockNotice->blocknotice_colorselector2); ?>" class="fa fa-5x <?php echo e($theeBlockNotice->blocknoticefaicon2); ?> text-center"></i>
                            </div>
                            <div class="card-section">
                                <h4><?php echo e($theeBlockNotice->blocknoticesubtitle2); ?></h4>
                                <p><?php echo allowedTags($theeBlockNotice->blocknoticedescrip2); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="cell medium-4">
                        <div class="card" data-equalizer-watch>
                            <div class="card-divider">
                                <h4 class="h4"><?php echo e($theeBlockNotice->blocknoticetitle3); ?></h4>
                            </div>
                            <div class="card-image">
                                <i style="color: <?php echo e($theeBlockNotice->blocknotice_colorselector3); ?>" class="fa fa-5x <?php echo e($theeBlockNotice->blocknoticefaicon3); ?> text-center"></i>
                            </div>
                            <div class="card-section">
                                <h4><?php echo e($theeBlockNotice->blocknoticesubtitle3); ?></h4>
                                <p><?php echo allowedTags($theeBlockNotice->blocknoticedescrip3); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

