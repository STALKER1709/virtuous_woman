@extends('layouts.app')
@section('content')

  <main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
      <h2 class="page-title">My Orders</h2>
      <div class="row">
        <div class="col-lg-3">
            @include('user.account-nav')
        </div>
        <div class="col-lg-9">
          <div class="page-content my-account__dashboard">
            @if ($orders->count() > 0)
              <div class="cart-table__wrapper">
                <table class="cart-table">
                  <thead>
                    <tr>
                      <th>Order No</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Total</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($orders as $order)
                      <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ number_format($order->total, 2) }}&euro;</td>
                        <td><a class="unerline-link" href="{{ route('user.order.details', $order->order_number) }}">View</a></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="mt-4">
                {{ $orders->links('pagination::bootstrap-5') }}
              </div>
            @else
              <p>You haven't placed any orders yet. <a class="unerline-link" href="{{ route('shop.index') }}">Start shopping</a>.</p>
            @endif
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection
