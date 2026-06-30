@extends('layouts.app')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">{{ __('messages.checkout_title') }}</h2>
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
                        <h3 class="mb-4">{{ __('messages.checkout_billing_details') }}</h3>
                        <div class="row">
                            <div class="col-md-6 form-label-fixed mb-4">
                                <label class="form-label">{{ __('messages.checkout_full_name') }} *</label>
                                <input type="text" name="name" class="form-control form-control_gray" value="{{ old('name', auth()->user()->name) }}" required>
                            </div>
                            <div class="col-md-6 form-label-fixed mb-4">
                                <label class="form-label">{{ __('messages.checkout_email') }} *</label>
                                <input type="email" name="email" class="form-control form-control_gray" value="{{ old('email', auth()->user()->email) }}" required>
                            </div>
                            <div class="col-md-6 form-label-fixed mb-4">
                                <label class="form-label">{{ __('messages.checkout_mobile') }} *</label>
                                <input type="text" name="mobile" class="form-control form-control_gray" value="{{ old('mobile', auth()->user()->mobile) }}" required>
                            </div>
                            <div class="col-md-6 form-label-fixed mb-4">
                                <label class="form-label">{{ __('messages.checkout_country') }} *</label>
                                <input type="text" name="country" class="form-control form-control_gray" value="{{ old('country') }}" required>
                            </div>
                            <div class="col-12 form-label-fixed mb-4">
                                <label class="form-label">{{ __('messages.checkout_address') }} *</label>
                                <input type="text" name="address" class="form-control form-control_gray" value="{{ old('address') }}" required>
                            </div>
                            <div class="col-md-4 form-label-fixed mb-4">
                                <label class="form-label">{{ __('messages.checkout_city') }} *</label>
                                <input type="text" name="city" class="form-control form-control_gray" value="{{ old('city') }}" required>
                            </div>
                            <div class="col-md-4 form-label-fixed mb-4">
                                <label class="form-label">{{ __('messages.checkout_state') }}</label>
                                <input type="text" name="state" class="form-control form-control_gray" value="{{ old('state') }}">
                            </div>
                            <div class="col-md-4 form-label-fixed mb-4">
                                <label class="form-label">{{ __('messages.checkout_zip') }} *</label>
                                <input type="text" name="zip" class="form-control form-control_gray" value="{{ old('zip') }}" required>
                            </div>
                            <div class="col-12 form-label-fixed mb-4">
                                <label class="form-label">{{ __('messages.checkout_notes') }}</label>
                                <textarea name="notes" class="form-control form-control_gray" rows="3">{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        <h3 class="mb-4 mt-2">{{ __('messages.checkout_payment_method') }}</h3>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="payment_cod" value="cod" {{ old('payment_method', 'cod') == 'cod' ? 'checked' : '' }}>
                            <label class="form-check-label" for="payment_cod">{{ __('messages.checkout_cod') }}</label>
                        </div>
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="payment_method" id="payment_bank" value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }}>
                            <label class="form-check-label" for="payment_bank">{{ __('messages.checkout_bank_transfer') }}</label>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" name="terms" id="terms" value="1" {{ old('terms') ? 'checked' : '' }} required>
                            <label class="form-check-label" for="terms">{!! __('messages.checkout_accept_terms', ['url' => route('legal.cgv')]) !!}</label>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="sticky-content">
                            <div class="shopping-cart__totals">
                                <h3>{{ __('messages.checkout_order_summary') }}</h3>
                                <ul class="list-unstyled mb-4">
                                    @foreach ($items as $item)
                                        <li class="d-flex justify-content-between py-2 border-bottom">
                                            <span>{{ $item->name }} &times; {{ $item->qty }}</span>
                                            <span>{{ $item->subtotal }}&euro;</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="mb-4">
                                    @if ($coupon)
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>Coupon <strong>{{ $coupon->code }}</strong> applied</span>
                                            <form method="post" action="{{ route('checkout.coupon.remove') }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">{{ __('messages.cart_remove') }}</button>
                                            </form>
                                        </div>
                                    @else
                                        <form method="post" action="{{ route('checkout.coupon.apply') }}" class="d-flex gap-2">
                                            @csrf
                                            <input type="text" name="code" class="form-control form-control_gray" placeholder="{{ __('messages.checkout_coupon_code') }}">
                                            <button type="submit" class="btn btn-outline-primary text-nowrap">{{ __('messages.checkout_apply_coupon') }}</button>
                                        </form>
                                    @endif
                                </div>
                                <table class="cart-totals">
                                    <tbody>
                                        <tr>
                                            <th>{{ __('messages.cart_subtotal') }}</th>
                                            <td>{{ number_format($subtotal, 2) }}&euro;</td>
                                        </tr>
                                        @if ($discount > 0)
                                            <tr>
                                                <th>{{ __('messages.checkout_discount') }} @if ($coupon)({{ $coupon->code }})@endif</th>
                                                <td>-{{ number_format($discount, 2) }}&euro;</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th>{{ __('messages.checkout_shipping') }}</th>
                                            <td>{{ $shipping > 0 ? number_format($shipping, 2).'€' : 'Free' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('messages.cart_total') }}</th>
                                            <td>{{ number_format($total, 2) }}&euro;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p class="small text-secondary mt-2">{{ __('messages.checkout_vat_note', ['rate' => 20, 'amount' => number_format($vatAmount, 2).'€']) }}</p>
                                <button type="submit" class="btn btn-primary w-100 mt-4">{{ __('messages.checkout_place_order') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection
