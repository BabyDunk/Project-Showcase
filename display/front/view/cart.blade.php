<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 02/05/2019
	 * Time: 22:05
	 */


?>

@extends('extends.base')

@section('title', sca_get_preference('showcase', 'sca_sitename') . ':  Shopping Cart')

@section('page-id', 'cart')

@section('content')
    <!-- Navigation -->
    @include('includes.shop-navi')
    <main>
        <div class="modal">
            <section id="personal-data">
                <figure id="personal-info">
                    <h2>Personal Info</h2>
                    <div class="notification"></div>
                    <div class="form-content">
                        <label for="cartName">Full Name</label>
                        <input type="text" id="cartName" required placeholder="Name linked to payment card" class="">
                    </div>
                    <div class="form-content">
                        <label for="cartAddress">Address</label>
                        <input type="text" id="cartAddress" required placeholder="Address linked to payment card" class="">
                    </div>
                    <div class="form-content">
                        <label for="cartEmail">Email</label>
                        <input type="text" id="cartEmail" required placeholder="Email to receive receipt" class="">
                    </div>
                    <div class="form-content">
                        <button class="button default left" id="backToCartView">Back to cart</button>
                        <button class="button success right" id="moveToFinancialView">Next!</button>
                    </div>
                </figure>
                @php \Classes\Core\PaymentGateway::echoStripeForm() @endphp
            </section>
        </div>
        <div class="container">
            @include('includes.messages')
            <div class="shopping-cart">
                <section id="cartListings">
                    <h1>{{sca_get_preference('showcase', 'sca_sitename')}} Shopping Cart</h1>
                    <ol id="cartListedItem">

                    </ol>
                </section>
                <section>
                    <div id="cartTotalling">
                        <label></label>
                        <div class="notification"></div>
                        <label for="discountedCode">Enter a valid promotion code</label>
                        <input id="discountedCode" placeholder="Promo Code">
                        <label for="discountedLinked">Email address linked to promotion code</label>
                        <input id="discountedLinked" placeholder="Email Address linked to promo code">
                        <label for="taxValue">Taxes</label>
                        <span id="taxValue">0.00</span>
                        <label for="totalValue">Total</label>
                        <span id="totalValue">0.00</span>
                        <label></label>
                        <div class="cartTotalControls">
                            <a href="#" id="cancelCart">Cancel This Cart</a>
                            <a href="#" id="updateCart">Update Cart</a>
                        </div>
                    </div>

                    <div class="cartCompleter">
                        <button class="success button" id="moveToGatherFin">Place Order</button>
                    </div>
                </section>
            </div>
        </div>
    </main>
    <!-- /.row -->

@endsection
