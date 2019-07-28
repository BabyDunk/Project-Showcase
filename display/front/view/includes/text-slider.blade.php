<?php
/**
 * Created by Chris Wilkinson.
 * Title: showcase_app
 * Date: 18/06/2018
 * Time: 23:55
 */
?>

@if(!empty(sca_get_preference('showcase', 'sca_frontinfoslider1')))
    <div id="text-slider">
        <!-- Page Content -->
        <div class="container">
            <div class="js-Carousel" id="shoptext-carousel">
                <ul>
                    <li class="cell">
                        <figure>
							<?php echo sca_get_preference( 'showcase' , 'sca_frontinfoslider1' ); ?>
                        </figure>
                    </li>
                    <li class="cell">
                        <figure>
							<?php echo sca_get_preference( 'showcase' , 'sca_frontinfoslider2' ); ?>
                        </figure>
                    </li>
                    <li class="cell">
                        <figure>
							<?php echo sca_get_preference( 'showcase' , 'sca_frontinfoslider3' ); ?>
                        </figure>
                    </li>
                    <li class="cell">
                        <figure>
							<?php echo sca_get_preference( 'showcase' , 'sca_frontinfoslider4' ); ?>
                        </figure>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endif