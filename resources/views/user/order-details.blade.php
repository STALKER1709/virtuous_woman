@extends('layouts.app')
@section('content')

  <main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
      <h2 class="page-title">Order {{ $order->order_number }}</h2>
      <div class="row">
        <div class="col-lg-3">
            @include('user.account-nav')
        </div>
        <div class="col-lg-9">
          <div class="page-content my-account__dashboard">
            <p>
              Placed on {{ $order->created_at->format('Y-m-d H:i') }} &middot;
              Status: <strong>{{ ucfirst($order->status) }}</strong> &middot;
              Payment: {{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Bank Transfer' }}
            </p>

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
                    <tr>
                      <th>Shipping</th>
                      <td>Free</td>
                    </tr>
                    <tr>
                      <th>Total</th>
                      <td>{{ number_format($order->total, 2) }}&euro;</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection
