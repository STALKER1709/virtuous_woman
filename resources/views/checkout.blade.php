@extends('layouts.app')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Checkout</h2>
            <div class="checkout-steps">
                <a href="{{ route('cart.index') }}" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>Shopping Bag</span>
                        <em>Manage Your Items List</em>
                    </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
                        <span>Shipping and Checkout</span>
                        <em>Checkout Your Items List</em>
                    </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
                        <span>Confirmation</span>
                        <em>Review And Submit Your Order</em>
                    </span>
                </a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('checkout.store') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-7">
                        <h3 class="mb-4">Shipping Information</h3>
                        <div class="row">
                            <div class="col-md-6 form-label-fixed mb-4">
                                <label class="form-label">Full Name *</label>
                                <input type="text" name="name" class="form-control form-control_gray" value="{{ old('name', auth()->user()->name) }}" required>
                            </div>
                            <div class="col-md-6 form-label-fixed mb-4">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-control form-control_gray" value="{{ old('email', auth()->user()->email) }}" required>
                            </div>
                            <div class="col-md-6 form-label-fixed mb-4">
                                <label class="form-label">Mobile *</label>
                                <input type="text" name="mobile" class="form-control form-control_gray" value="{{ old('mobile', auth()->user()->mobile) }}" required>
                            </div>
                            <div class="col-md-6 form-label-fixed mb-4">
                                <label class="form-label">Country *</label>
                                <input type="text" name="country" class="form-control form-control_gray" value="{{ old('country') }}" required>
                            </div>
                            <div class="col-12 form-label-fixed mb-4">
                                <label class="form-label">Address *</label>
                                <input type="text" name="address" class="form-control form-control_gray" value="{{ old('address') }}" required>
                            </div>
                            <div class="col-md-4 form-label-fixed mb-4">
                                <label class="form-label">City *</label>
                                <input type="text" name="city" class="form-control form-control_gray" value="{{ old('city') }}" required>
                            </div>
                            <div class="col-md-4 form-label-fixed mb-4">
                                <label class="form-label">State / Province</label>
                                <input type="text" name="state" class="form-control form-control_gray" value="{{ old('state') }}">
                            </div>
                            <div class="col-md-4 form-label-fixed mb-4">
                                <label class="form-label">Zip / Postal Code *</label>
                                <input type="text" name="zip" class="form-control form-control_gray" value="{{ old('zip') }}" required>
                            </div>
                            <div class="col-12 form-label-fixed mb-4">
                                <label class="form-label">Order Notes (optional)</label>
                                <textarea name="notes" class="form-control form-control_gray" rows="3">{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        <h3 class="mb-4 mt-2">Payment Method</h3>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="payment_cod" value="cod" {{ old('payment_method', 'cod') == 'cod' ? 'checked' : '' }}>
                            <label class="form-check-label" for="payment_cod">Cash on Delivery</label>
                        </div>
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="payment_method" id="payment_bank" value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }}>
                            <label class="form-check-label" for="payment_bank">Bank Transfer</label>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="sticky-content">
                            <div class="shopping-cart__totals">
                                <h3>Order Summary</h3>
                                <ul class="list-unstyled mb-4">
                                    @foreach ($items as $item)
                                        <li class="d-flex justify-content-between py-2 border-bottom">
                                            <span>{{ $item->name }} &times; {{ $item->qty }}</span>
                                            <span>{{ $item->subtotal }}&euro;</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <table class="cart-totals">
                                    <tbody>
                                        <tr>
                                            <th>Subtotal</th>
                                            <td>{{ Cart::instance('cart')->subtotal() }}&euro;</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping</th>
                                            <td>Free</td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td>{{ Cart::instance('cart')->total() }}&euro;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary w-100 mt-4">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection
