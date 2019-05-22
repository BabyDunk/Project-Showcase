<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 27/05/2018
	 * Time: 15:46
	 */


	$promo = (!empty($promotion)) ? $promotion : '';

	?>

@extends('extends.admin-base')

@section('title', 'Add Promotion')

@section('page-id', 'add-promotion')

@section('content')
        <div class="grid-container">
            <div class="grid-padding-x grid-x">
                <div class="medium-8 medium-offset-2 large-8 large-offset-2 cell">
                    <div class="callout loginpanel secondary clearfix">
                    <h1 class="page-header">
                        New Promotion
                        <small>Add Promotion</small>
                    </h1>

                    <div class="callout clearfix">
                        <h2>Promote By Discount</h2>
                        @include('includes.messages')
                        <form method="post" action="" enctype="multipart/form-data">
                            <input type="hidden" name="CSRFToken" value="<?php echo \Classes\Core\CSRFToken::_SetToken(); ?>"/>


                            <label for="promo_image" class="button">Promotion Image</label>
                            <input type="file" class="show-for-sr" id="promo_image" name="promo_image" >
                            <small>Add promotion image</small>
                            @if(!empty($promo))
                            <div class="img-box">
                                <img src="{{$promo->get_picture()}}" alt="{{$promo->title}}">
                            </div>
                            @endif
                            <label for="promo_code">Promo Code</label>
                            <input type="text" class="form-control" id="promo_code" required name="promo_code" value="@php echo (!empty($promo->promo_code)) ? $promo->promo_code : '' @endphp" placeholder="Enter a Promotion Code">

                            <label for="conversion">Promotion Value Type <small>eg; fixed price or percentage off price</small></label>
                            <select class="form-control" name="conversion" required id="conversion">
                                <option value=""></option>
                                <option value="1" @php echo (!empty($promo->conversion) && $promo->conversion === 1) ? 'selected' : '' @endphp>Fixed Price</option>
                                <option value="2" @php echo (!empty($promo->conversion) && $promo->conversion === 2) ? 'selected' : '' @endphp>Fixed Price per Item</option>
                                <option value="3" @php echo (!empty($promo->conversion) && $promo->conversion === 3) ? 'selected' : '' @endphp>Percentage</option>
                            </select>

                            <label for="promo_value">Promotion Value</label>
                            <input type="number" class="form-control" id="promo_value" required name="promo_value" value="@php echo (!empty($promo->value)) ? ($promo->value/100) : '' @endphp" placeholder="Enter a Promotion Value">

                            <fieldset class="fieldset">
                                <legend>Activate The Promotion</legend>

                                <div class="switch">
                                    <input class="switch-input" type="checkbox" name="promo_valid" @php echo ($promo->valid) ? 'checked' : '' @endphp id="promo_valid"
                                           value="1" />
                                    <label class="switch-paddle" for="promo_valid">
                                        <span class="show-for-sr">Switch this promote on or off</span>
                                        <span class="switch-active" aria-hidden="true">Yes</span>
                                        <span class="switch-inactive" aria-hidden="true">No</span>
                                    </label>
                                </div>
                            </fieldset>

                            <label for="promo_valid_email">Link Promo Code</label>
                            <input type="email" class="form-control" id="promo_valid_email" name="promo_valid_email"  value="@php echo (!empty($promo->valid_email)) ? $promo->valid_email : '' @endphp"  placeholder="Link this promo code to an email address">

                            <label for="promo_start_date">Promo Start Date</label>
                            <input type="date" class="form-control" id="promo_start_date" name="promo_start_date"  value="@php echo (!empty($promo->start_date)) ? substr($promo->start_date, 0, 10) : '' @endphp"  required placeholder="Promo start date">

                            <label for="promo_end_date">Promo End Date</label>
                            <input type="date" class="form-control" id="promo_end_date" name="promo_end_date"  value="@php echo (!empty($promo->end_date)) ?  substr($promo->end_date, 0, 10) : '' @endphp"  required placeholder="Promo end date">

                           <fieldset class="fieldset" id="promo-showcases">
                               <legend>Which Items Are Included In This Promotion</legend>
                               <table>
                                   <tr>
                                       <td>Name</td>
                                       <td>Price</td>
                                       <td>Include</td>
                                   </tr>

                                   @foreach(\Classes\Core\Showcase::find_all() as $item)
                                       @if(isset($item->price))
                                       <tr>
                                           <td>{{$item->title}}</td>
				                           <?php // TODO: fix the problem of set price when listing showcase; ?>
                                           <td>{{sca_show_price($item->price)}}</td>
                                           <td><input type="checkbox" id="promo_included_items" name="promo_included_items[]"  @php
                                                    $allowedItems = unserialize($promo->valid_for_items);
                                                    $isSelected  = false;
                                                    if(is_array($allowedItems)){
                                                        if(in_array($item->id, $allowedItems)){
                                                            $isSelected = true;
                                                        }
                                                    }

                                                   echo ($isSelected) ? 'checked' : '' @endphp value="{{$item->id}}"></td>
                                       </tr>
                                       @endif
                                   @endforeach
                               </table>
                           </fieldset>

                            <button type="submit" name="create" value="true" class="button primary expanded">Add Promotion</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
@endsection
