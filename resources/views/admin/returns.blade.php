@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Return Requests</h3>
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
                        <div class="text-tiny">Return Requests</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                @if (Session::has('status'))
                    <p class="alert alert-success">{{ Session::get('status') }}</p>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Order No</th>
                                <th>Customer</th>
                                <th>Reason</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($returns as $return)
                                <tr>
                                    <td>{{ $return->order->order_number }}</td>
                                    <td>{{ $return->user->name }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($return->reason, 60) }}</td>
                                    <td>{{ ucfirst($return->status) }}</td>
                                    <td>{{ $return->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <div class="list-icon-function">
                                            <a href="{{ route('admin.return.details', $return->id) }}">
                                                <div class="item eye">
                                                    <i class="icon-eye"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No return requests yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{ $returns->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
