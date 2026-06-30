@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Order {{ $order->order_number }}</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders') }}">
                            <div class="text-tiny">All Orders</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">{{ $order->order_number }}</div>
                    </li>
                </ul>
            </div>

            @if (Session::has('status'))
                <p class="alert alert-success">{{ Session::get('status') }}</p>
            @endif

            <div class="wg-box mb-4">
                <h5 class="mb-3">Update Status</h5>
                <form method="POST" action="{{ route('admin.order.status.update', $order->id) }}" class="flex items-center gap10 flex-wrap">
                    @csrf
                    @method('PUT')
                    <select name="status" class="form-control" style="max-width: 220px;">
                        @foreach (['pending','processing','shipped','delivered','cancelled'] as $status)
                            <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="tf-button style-1 w208">Update</button>
                </form>
            </div>

            <div class="wg-box mb-4">
                <h5 class="mb-3">Customer & Shipping</h5>
                <p class="mb-1"><strong>{{ $order->name }}</strong></p>
                <p class="mb-1">{{ $order->email }} &middot; {{ $order->mobile }}</p>
                <p class="mb-1">{{ $order->address }}, {{ $order->city }}{{ $order->state ? ', '.$order->state : '' }} {{ $order->zip }}</p>
                <p class="mb-1">{{ $order->country }}</p>
                @if ($order->notes)
                    <p class="mb-1"><em>Notes: {{ $order->notes }}</em></p>
                @endif
                <p class="mb-0">Payment: {{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Bank Transfer' }}</p>
            </div>

            <div class="wg-box">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
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
                                    <td>€{{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>€{{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Subtotal</th>
                                <th>€{{ number_format($order->subtotal, 2) }}</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-end">Total</th>
                                <th>€{{ number_format($order->total, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
