<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 28/05/2018
	 * Time: 01:59
	 */


	?>



<?php $__env->startSection('title', 'General Settings'); ?>

<?php $__env->startSection('page-id', 'settings'); ?>

<?php $__env->startSection('content'); ?>
    <div id="page-wrapper">


            <!-- Page Heading -->
            <div class="grid-x">
                <div class="large-12">
                    <h1 class="page-header">
                        Settings
                        <small>General Settings</small>
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

                    <form method="POST" action="/admin/general_settings" enctype="multipart/form-data">
                        <input type="hidden" name="CSRFToken" value="<?php echo \Classes\Core\CSRFToken::_SetToken(); ?>"/>
                        <div class="grid-container full">
                            <div class="grid-x grid-padding-x">
                                <div class="medium-6">
                                    <fieldset class="fieldset full">
                                        <legend>Site Identity</legend>

                                        <label for="sitename">Website Name</label>
                                        <input class="form-control" type="text" name="sitename" id="sitename" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_sitename'))) ? sca_get_preference('showcase', 'sca_sitename') : ''; ?>" placeholder="Give this website a name" />

                                        <label for="siteurl">Website URL</label>
                                        <input class="form-control" type="text" name="siteurl" id="siteurl" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_siteurl'))) ? sca_get_preference('showcase', 'sca_siteurl') : ''; ?>" placeholder="Give this website a url" />

                                        <label for="sitetitle">Website Title</label>
                                        <input class="form-control" type="text" name="sitetitle" id="sitetitle" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_sitetitle'))) ? sca_get_preference('showcase', 'sca_sitetitle') : ''; ?>" placeholder="Give this website a title" />

                                        <label for="sitesubtitle">Website Subtitle</label>
                                        <input class="form-control" type="text" name="sitesubtitle" id="sitesubtitle" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_sitesubtitle'))) ? sca_get_preference('showcase', 'sca_sitesubtitle') : ''; ?>" placeholder="Give this website a subtitle" />

                                        <label for="sitecontact">Website Contact Email</label>
                                        <input class="form-control" type="email" name="sitecontact" id="sitecontact" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_sitecontact'))) ? sca_get_preference('showcase', 'sca_sitecontact') : ''; ?>" placeholder="Give this website a contact email address" />

                                        <label for="sitenumber">Website Contact Number</label>
                                        <input class="form-control" type="text" name="sitenumber" id="sitenumber" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_sitenumber'))) ? sca_get_preference('showcase', 'sca_sitenumber') : ''; ?>" placeholder="Give the website a contact phone number" />
                                    </fieldset>

                                    <fieldset class="fieldset full">
                                        <legend>About statement</legend>

                                        <span data-tooltip aria-haspopup="true" class="has-tip right" data-disable-hover="false" tabindex=1 title="<div class='callout'> call this input with the following function sca_get_preference('showcase', 'sca_sitedescriptionshort') </div>"><i class="fa fa-info-circle"></i></span>
                                        <label for="sitedescriptionshort">Website About Us Short Description</label>
                                        <textarea class="form-control" name="sitedescriptionshort" id="sitedescriptionshort" placeholder="Describe in short what we do here" ><?php echo (!empty(sca_get_preference('showcase', 'sca_sitedescriptionshort'))) ? sca_get_preference('showcase', 'sca_sitedescriptionshort') : ''; ?></textarea>

                                        <label for="sitedescriptionfull">Website About US Full Description</label>
                                        <textarea class="form-control" name="sitedescriptionfull" id="sitedescriptionfull" placeholder="Describe in full what we do here" ><?php echo (!empty(sca_get_preference('showcase', 'sca_sitedescriptionfull'))) ? sca_get_preference('showcase', 'sca_sitedescriptionfull') : ''; ?></textarea>
                                    </fieldset>

                                    <fieldset class="fieldset full">
                                        <legend>Contact statement</legend>

                                        <label for="contacttitle">Contact Title</label>
                                        <input class="form-control" type="text" name="contacttitle" id="contacttitle" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_contacttitle'))) ? sca_get_preference('showcase', 'sca_contacttitle') : ''; ?>" placeholder="Contact title notice" />

                                        <label for="contactdescription">Contact Description</label>
                                        <textarea class="form-control" name="contactdescription" id="contactdescription" placeholder="Describe in full what we do here" ><?php echo (!empty(sca_get_preference('showcase', 'sca_contactdescription'))) ? sca_get_preference('showcase', 'sca_contactdescription') : ''; ?></textarea>
                                    </fieldset>

                                    <fieldset class="fieldset">
                                        <legend>Frontend Settings</legend>


                                        <fieldset class="fieldset">
                                            <legend>Featured Listings On Home Page</legend>

                                            <label for="howmanyfrontfeatured">Set how many featured should be visible on home page</label>
                                            <input type="number" name="howmanyfrontfeatured" id="howmanyfrontfeatured" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_howmanyfrontfeatured'))) ? sca_get_preference('showcase', 'sca_howmanyfrontfeatured') : '' ?>" />


                                            <p>Which order to display featured listing?</p>
                                            <div class="switch">
                                                <input class="switch-input" id="whichorderfeatured0" type="radio" value="0" <?php echo (empty(sca_get_preference('showcase', 'sca_whichorderfeatured'))) ? 'checked' : ''; ?> checked name="whichorderfeatured">
                                                <label class="switch-paddle" for="whichorderfeatured0">
                                                    <span class="show-for-sr">Newest First</span>
                                                    <span class="switch-active" aria-hidden="true">None</span>
                                                    <span class="switch-inactive" aria-hidden="true"></span>
                                                </label>
                                            </div>
                                            <div class="switch">
                                                <input class="switch-input" id="whichorderfeatured1" type="radio" value="1" <?php echo (!empty(sca_get_preference('showcase', 'sca_whichorderfeatured')) && sca_get_preference('showcase', 'sca_whichorderfeatured') === 1) ? 'checked' : ''; ?>  name="whichorderfeatured">
                                                <label class="switch-paddle" for="whichorderfeatured1">
                                                    <span class="show-for-sr">Newest First</span>
                                                    <span class="switch-active" aria-hidden="true">Newest</span>
                                                    <span class="switch-inactive" aria-hidden="true"></span>
                                                </label>
                                            </div>
                                            <div class="switch">
                                                <input class="switch-input" id="whichorderfeatured2" type="radio" value="2"  <?php echo (!empty(sca_get_preference('showcase', 'sca_whichorderfeatured')) && sca_get_preference('showcase', 'sca_whichorderfeatured') === 2) ? 'checked' : ''; ?>  name="whichorderfeatured">
                                                <label class="switch-paddle" for="whichorderfeatured2">
                                                    <span class="show-for-sr">Oldest First</span>
                                                    <span class="switch-active" aria-hidden="true">Oldest</span>
                                                    <span class="switch-inactive" aria-hidden="true"></span>
                                                </label>
                                            </div>
                                            <div class="switch">
                                                <input class="switch-input" id="whichorderfeatured3" type="radio" value="3" <?php echo (!empty(sca_get_preference('showcase', 'sca_whichorderfeatured')) && sca_get_preference('showcase', 'sca_whichorderfeatured') === 3) ? 'checked' : ''; ?>   name="whichorderfeatured">
                                                <label class="switch-paddle" for="whichorderfeatured3">
                                                    <span class="show-for-sr">Random</span>
                                                    <span class="switch-active" aria-hidden="true">Random</span>
                                                    <span class="switch-inactive" aria-hidden="true"></span>
                                                </label>
                                            </div>
                                        </fieldset>

                                        <fieldset class="fieldset">
                                            <legend>Featured Slider Images</legend>

                                            <label for="howmanyfrontfeaturedimg">How many featured slider images should be presented</label>
                                            <input type="number" name="howmanyfrontfeaturedimg" id="howmanyfrontfeaturedimg" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_howmanyfrontfeaturedimg'))) ? sca_get_preference('showcase', 'sca_howmanyfrontfeaturedimg') : '' ?>" />


                                            <p>Which order to display slider images?</p>
                                            <div class="switch">
                                                <input class="switch-input" id="whichorderfeaturedimg0" type="radio" value="0" <?php echo (empty(sca_get_preference('showcase', 'sca_whichorderfeaturedimg'))) ? 'checked' : ''; ?> checked name="whichorderfeaturedimg">
                                                <label class="switch-paddle" for="whichorderfeaturedimg0">
                                                    <span class="show-for-sr">Newest First</span>
                                                    <span class="switch-active" aria-hidden="true">None</span>
                                                    <span class="switch-inactive" aria-hidden="true"></span>
                                                </label>
                                            </div>
                                            <div class="switch">
                                                <input class="switch-input" id="whichorderfeaturedimg1" type="radio" value="1" <?php echo (!empty(sca_get_preference('showcase', 'sca_whichorderfeaturedimg')) && sca_get_preference('showcase', 'sca_whichorderfeaturedimg') === 1) ? 'checked' : ''; ?>  name="whichorderfeaturedimg">
                                                <label class="switch-paddle" for="whichorderfeaturedimg1">
                                                    <span class="show-for-sr">Newest First</span>
                                                    <span class="switch-active" aria-hidden="true">Newest</span>
                                                    <span class="switch-inactive" aria-hidden="true"></span>
                                                </label>
                                            </div>
                                            <div class="switch">
                                                <input class="switch-input" id="whichorderfeaturedimg2" type="radio" value="2"  <?php echo (!empty(sca_get_preference('showcase', 'sca_whichorderfeaturedimg')) && sca_get_preference('showcase', 'sca_whichorderfeaturedimg') === 2) ? 'checked' : ''; ?>  name="whichorderfeaturedimg">
                                                <label class="switch-paddle" for="whichorderfeaturedimg2">
                                                    <span class="show-for-sr">Oldest First</span>
                                                    <span class="switch-active" aria-hidden="true">Oldest</span>
                                                    <span class="switch-inactive" aria-hidden="true"></span>
                                                </label>
                                            </div>
                                            <div class="switch">
                                                <input class="switch-input" id="whichorderfeaturedimg3" type="radio" value="3" <?php echo (!empty(sca_get_preference('showcase', 'sca_whichorderfeaturedimg')) && sca_get_preference('showcase', 'sca_whichorderfeaturedimg') === 3) ? 'checked' : ''; ?>   name="whichorderfeaturedimg">
                                                <label class="switch-paddle" for="whichorderfeaturedimg3">
                                                    <span class="show-for-sr">Random</span>
                                                    <span class="switch-active" aria-hidden="true">Random</span>
                                                    <span class="switch-inactive" aria-hidden="true"></span>
                                                </label>
                                            </div>
                                        </fieldset>
                                        <fieldset class="fieldset full">
                                            <legend>Info Slider</legend>

                                            <label for="frontinfoslider1">Info 1</label>
                                            <textarea class="form-control" name="frontinfoslider1" id="frontinfoslider1" placeholder="Describe in full what we do here" ><?php echo (!empty(sca_get_preference('showcase', 'sca_frontinfoslider1'))) ? sca_get_preference('showcase', 'sca_frontinfoslider1') : ''; ?></textarea>

                                            <label for="frontinfoslider2">Info 2</label>
                                            <textarea class="form-control" name="frontinfoslider2" id="frontinfoslider2" placeholder="Describe in full what we do here" ><?php echo (!empty(sca_get_preference('showcase', 'sca_frontinfoslider2'))) ? sca_get_preference('showcase', 'sca_frontinfoslider2') : ''; ?></textarea>

                                            <label for="frontinfoslider3">Info 3</label>
                                            <textarea class="form-control" name="frontinfoslider3" id="frontinfoslider3" placeholder="Describe in full what we do here" ><?php echo (!empty(sca_get_preference('showcase', 'sca_frontinfoslider3'))) ? sca_get_preference('showcase', 'sca_frontinfoslider3') : ''; ?></textarea>

                                            <label for="frontinfoslider4">Info 4</label>
                                            <textarea class="form-control" name="frontinfoslider4" id="frontinfoslider4" placeholder="Describe in full what we do here" ><?php echo (!empty(sca_get_preference('showcase', 'sca_frontinfoslider4'))) ? sca_get_preference('showcase', 'sca_frontinfoslider4') : ''; ?></textarea>

                                        </fieldset>
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