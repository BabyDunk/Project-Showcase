<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 02/05/2019
	 * Time: 22:05
	 */

//var_dump($transsuccess)
?>

@extends('extends.base')

@section('title', sca_get_preference('showcase', 'sca_sitename') . ':  Successful Payment')

@section('page-id', 'cart-payment-notice')

@section('content')
    <!-- Navigation -->
    @include('includes.shop-navi')

    <main>
        <div class="container">
            <div id="success-box">
                <div class="display-side">
                    @if($transsuccess->paid)
                    <div>

                        <h1>Payment Successful</h1>
                        <p>Congratulation {{ucwords($trans->name)}}, We have received your payment. Please check you email and follow the
                            link provided to download your software.</p>

                    </div>
                    <div>
                        <img class="thumbnail" src="{{ASSETS_IMAGES_PATH_URL}}paid.png" alt="Paid">
                    </div>
                    @else
                        <div>

                            <h1>Payment Unsuccessful</h1>
                            <p>Sorry {{ucwords($trans->name)}} but your payment didn't complete. You bank returned error: {{$transsuccess->failure_message}}</p>

                        </div>
                        <div>
                            <img class="thumbnail" src="{{ASSETS_IMAGES_PATH_URL}}fail.jpg" alt="Paid">
                        </div>
                    @endif
                </div>

                @if($transsuccess->paid)
                <div class="split-12">
                    <fieldset class="fieldset">
                        <legend>Promotion</legend>


                        @if(!empty($promo))
                            {{-- TODO: add promo for paying customers --}}
                            <h3>Promotions For Valued Customers</h3>
                            <p>This is promo needs filled in </p>
                        @else

                            <h3>Promotions For Valued Customers</h3>
                            <p>We dont have any promotion running at the moment but be sure to check back as this could
                                change from week to week</p>
                        @endif


                    </fieldset>
                </div>
                @endif
                <div class="split-12">
                    <fieldset class="fieldset">
                        <legend>Purchased Item(s)</legend>

                        <table>
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php $total = 0 @endphp
                            @foreach($cart->sca_shopping_cart->cart as $item)
                                @php

                                    $subtotal = $item->price*$item->quantity;
                                    $total += $subtotal;

                                @endphp
                                <tr>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>@php echo sca_show_price($item->price, true) @endphp</td>
                                    <td>@php echo sca_show_price($subtotal, true) @endphp</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Total:</td>
                                <td>{{sca_show_price($total,true)}}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </fieldset>
                </div>


            </div>

        </div>
    </main>
    <!-- /.row -->

@endsection
