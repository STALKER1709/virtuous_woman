@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Return for Order {{ $return->order->order_number }}</h3>
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
                        <a href="{{ route('admin.returns') }}">
                            <div class="text-tiny">Return Requests</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">{{ $return->order->order_number }}</div>
                    </li>
                </ul>
            </div>

            @if (Session::has('status'))
                <p class="alert alert-success">{{ Session::get('status') }}</p>
            @endif

            <div class="wg-box mb-4">
                <h5 class="mb-3">Customer & Reason</h5>
                <p class="mb-1"><strong>{{ $return->user->name }}</strong> &middot; {{ $return->user->email }}</p>
                <p class="mb-1">Requested on {{ $return->created_at->format('Y-m-d H:i') }}</p>
                <p class="mb-0"><em>{{ $return->reason }}</em></p>
            </div>

            <div class="wg-box mb-4">
                <h5 class="mb-3">Update Status</h5>
                <form method="POST" action="{{ route('admin.return.status.update', $return->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <select name="status" class="form-control" style="max-width: 220px;">
                            @foreach (['requested','approved','rejected','refunded'] as $status)
                                <option value="{{ $status }}" {{ $return->status === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Note to customer (optional)</label>
                        <textarea name="admin_notes" class="form-control" rows="3">{{ $return->admin_notes }}</textarea>
                    </div>
                    <button type="submit" class="tf-button style-1 w208">Update</button>
                </form>
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
                            @foreach ($return->order->items as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>€{{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>€{{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
