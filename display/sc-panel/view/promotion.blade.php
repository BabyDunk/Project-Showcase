<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 28/05/2018
	 * Time: 01:43
	 */

$promos =  \Classes\Core\Promotions::find_all();

?>

@extends('extends.admin-base')

@section('title', 'Promotions')

@section('page-id', 'promotions')

@section('content')
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Promotions
                    <small><a href="/sc-panel/add_promotion" >Add Promotion</a></small>
                </h1>
                @include('includes.messages')
                <div class="col-md-12">
                    <table class="hover unstriped stack">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Promotion Image</th>
                            <th>Promo Data</th>
                            <th>Promoted Items</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Created Date</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php foreach ( $promos as $promo ) : ?>
                        <tr>
                            <td>
                                <h3><?php echo $promo->id; ?></h3>
	                            <?php echo ($promo->valid) ? '<span class="successful">Active</span>' : '<span class="warned">Disabled</span>' ?>
                                <div class="action_link">

                                    <a href="/sc-panel/updatepromo/<?php echo $promo->id; ?>/edit">Edit</a>
                                    <a href="/sc-panel/promo/<?php echo $promo->id; ?>/delete">Delete</a>

                                </div>
                            </td>
                            <td><img class="img-responsive user-image" src="<?php echo $promo->get_picture(); ?>" /></td>
                            <td><div class="promo-info">
                                    <span><strong>Promo Code: </strong></span><span class="promo-cap"><?php echo $promo->promo_code; ?></span>
                                    <span><strong>Promo Value: </strong></span><span><?php

                                            $promoCorrection = ($promo->value/100);
                                            $currencyEntity = currencyType()[2];
	                                    $promoValue = '';
	                                    if($promo->conversion === 1){
		                                    $promoValue = $currencyEntity.$promoCorrection;
	                                    }else if($promo->conversion === 2){
		                                    $promoValue = $currencyEntity.$promoCorrection. " per Item";
	                                    }else if($promo->conversion === 3){
		                                    $promoValue = $promoCorrection."%";
	                                    }

	                                    echo $promoValue

	                                    ?>
                                    </span>
                                    <span><strong>Promo Linked: </strong></span><span><?php echo (!empty($promo->valid_email)) ? $promo->valid_email : 'None'; ?></span>
                                </div>
                            </td>
                            <td>
                                <?php
                                   if( $promo->valid_for_items){
                                   	$allowedItems = unserialize( $promo->valid_for_items);
                                   	$html = '<figure class="promo-info">';
                                   	$html .= '<span class="bold">Title</span><span class="bold">Price</span>';
                                   	foreach ($allowedItems as $item){
                                   		$thisItem = \Classes\Core\Showcase::find_by_id($item);
                                            if(strlen($thisItem->title)>30){
                                            	$thisTitle = substr($thisItem->title, 30).'...';
                                            }else{
                                            	$thisTitle = $thisItem->title;
                                            }
                                   		$html .= '<span>'.$thisTitle.'</span>';
                                   		$html .= '<span>'.sca_show_price($thisItem->price,true).'</span>';
                                    }
                                   	$html .= '</firgure>';

                                   	echo $html;
                                   }

                                ?>
                            </td>
                            <td><p><?php echo substr($promo->start_date, 0, 10); ?></p></td>
                            <td><p><?php echo substr($promo->end_date, 0, 10 ); ?></p></td>
                            <td><p><?php echo $promo->created_at; ?></p></td>
                        </tr>

						<?php endforeach; ?>


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
@endsection