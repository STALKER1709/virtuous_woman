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
            @if (session('success'))
              <p class="alert alert-success">{{ session('success') }}</p>
            @endif
            @if ($errors->any())
              <p class="alert alert-danger">{{ $errors->first() }}</p>
            @endif
            <p>
              {{ __('messages.order_placed_on') }} {{ $order->created_at->format('Y-m-d H:i') }} &middot;
              {{ __('messages.order_status_label') }}: <strong>{{ ucfirst($order->status) }}</strong> &middot;
              {{ __('messages.order_payment_label') }}: {{ $order->payment_method === 'cod' ? __('messages.checkout_cod') : __('messages.checkout_bank_transfer') }}
            </p>

            <p>
              <a href="{{ route('user.order.invoice', $order->order_number) }}" class="btn btn-outline-primary-2">
                <span>{{ __('messages.account_download_invoice') }}</span>
              </a>
            </p>

            <div class="cart-table__wrapper">
              <table class="cart-table">
                <thead>
                  <tr>
                    <th>{{ __('messages.cart_product') }}</th>
                    <th>{{ __('messages.cart_price') }}</th>
                    <th>{{ __('messages.cart_quantity') }}</th>
                    <th>{{ __('messages.cart_total') }}</th>
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
                <h5>{{ __('messages.account_address_title') }}</h5>
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
                      <th>{{ __('messages.cart_subtotal') }}</th>
                      <td>{{ number_format($order->subtotal, 2) }}&euro;</td>
                    </tr>
                    <tr>
                      <th>{{ __('messages.checkout_shipping') }}</th>
                      <td>{{ number_format($order->total - $order->subtotal, 2) }}&euro;</td>
                    </tr>
                    <tr>
                      <th>{{ __('messages.cart_total') }}</th>
                      <td>{{ number_format($order->total, 2) }}&euro;</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            @if ($order->status === 'delivered')
              <div class="row mt-4">
                <div class="col-12">
                  <h5>{{ __('messages.return_title') }}</h5>
                  @if ($order->orderReturn)
                    <p class="mb-0">{{ __('messages.return_status_label') }}: <strong>{{ ucfirst($order->orderReturn->status) }}</strong></p>
                    @if ($order->orderReturn->admin_notes)
                      <p class="mb-0"><em>{{ $order->orderReturn->admin_notes }}</em></p>
                    @endif
                  @elseif ($order->updated_at->diffInDays(now()) <= 14)
                    <form method="POST" action="{{ route('user.order.return', $order->order_number) }}">
                      @csrf
                      <div class="form-label-fixed mb-2">
                        <textarea name="reason" class="form-control form-control_gray" rows="3" placeholder="{{ __('messages.return_reason_placeholder') }}" required></textarea>
                      </div>
                      <button type="submit" class="btn btn-outline-primary-2">
                        <span>{{ __('messages.return_request_button') }}</span>
                      </button>
                    </form>
                  @else
                    <p class="mb-0">{{ __('messages.return_window_closed') }}</p>
                  @endif
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection
