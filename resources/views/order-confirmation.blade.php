@extends('layouts.app')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <div class="checkout-steps">
                <a href="{{ route('cart.index') }}" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>Shopping Bag</span>
                        <em>Manage Your Items List</em>
                    </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
                        <span>Shipping and Checkout</span>
                        <em>Checkout Your Items List</em>
                    </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
                        <span>Confirmation</span>
                        <em>Review And Submit Your Order</em>
                    </span>
                </a>
            </div>

            <div class="text-center py-5">
                <h2 class="page-title">Thank you, {{ $order->name }}!</h2>
                <p class="fs-5">Your order has been placed successfully.</p>
                <p>Order number: <strong>{{ $order->order_number }}</strong></p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="cart-table__wrapper">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ number_format($item->price, 2) }}&euro;</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->price * $item->quantity, 2) }}&euro;</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>Shipping Address</h5>
                            <p class="mb-0">{{ $order->name }}</p>
                            <p class="mb-0">{{ $order->address }}</p>
                            <p class="mb-0">{{ $order->city }}{{ $order->state ? ', '.$order->state : '' }} {{ $order->zip }}</p>
                            <p class="mb-0">{{ $order->country }}</p>
                            <p class="mb-0">{{ $order->mobile }}</p>
                        </div>
                        <div class="col-md-6">
                            <table class="cart-totals w-100">
                                <tbody>
                                    <tr>
                                        <th>Subtotal</th>
                                        <td>{{ number_format($order->subtotal, 2) }}&euro;</td>
                                    </tr>
                                    @if ($order->discount > 0)
                                        <tr>
                                            <th>Discount @if ($order->coupon_code)({{ $order->coupon_code }})@endif</th>
                                            <td>-{{ number_format($order->discount, 2) }}&euro;</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th>Shipping</th>
                                        <td>{{ $order->shipping > 0 ? number_format($order->shipping, 2).'€' : 'Free' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td>{{ number_format($order->total, 2) }}&euro;</td>
                                    </tr>
                                    <tr>
                                        <th>incl. VAT ({{ rtrim(rtrim(number_format($order->vat_rate, 2), '0'), '.') }}%)</th>
                                        <td>{{ number_format($order->vat_amount, 2) }}&euro;</td>
                                    </tr>
                                    <tr>
                                        <th>Payment Method</th>
                                        <td>{{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Bank Transfer' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{{ ucfirst($order->status) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="text-center mt-5">
                        <a href="{{ route('shop.index') }}" class="btn btn-primary">Continue Shopping</a>
                        <a href="{{ route('user.orders') }}" class="btn btn-light">View My Orders</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
