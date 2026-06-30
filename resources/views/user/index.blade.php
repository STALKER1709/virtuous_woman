@extends('layouts.app')
@section('content')

  <main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
      <h2 class="page-title">My Sisterhood Account</h2>
      <div class="row">
        <div class="col-lg-3">
            @include('user.account-nav')
        </div>
        <div class="col-lg-9">
          <div class="page-content my-account__dashboard">
            <p>Welcome to your <strong>Sisterhood Space</strong> 🌸</p>
            <p>From your empowerment dashboard you can view your <a class="unerline-link" href="{{ route('user.orders') }}">recent
                orders</a>, manage your <a class="unerline-link" href="{{ route('user.address') }}">shipping
                addresses</a>, and <a class="unerline-link" href="{{ route('user.details') }}">update your personal information</a>.</p>
            <p class="mt-4">Remember, you're part of a community that celebrates <strong>authenticity, style, and empowerment</strong>.
              Every purchase supports our mission to inspire and uplift women worldwide.</p>

            <div class="mt-4 pt-3 border-top">
              <h5 class="mb-3" style="color: var(--virtuous-orange);">Recent Orders</h5>
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
              @else
                <p>You haven't placed any orders yet. <a class="unerline-link" href="{{ route('shop.index') }}">Start shopping</a>.</p>
              @endif
            </div>

            <div class="mt-4 pt-3 border-top">
              <h5 class="mb-3" style="color: var(--virtuous-orange);">Daily Inspiration</h5>
              <blockquote class="fs-5 fst-italic" style="color: var(--virtuous-dark);">
                "Treme ipsorn dissure exercatocond iac ocp alatet varve strane in he estu tonic ho turned to blueento horinx oport prandi etap."
              </blockquote>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection