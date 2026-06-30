@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Coupons</h3>
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
                        <div class="text-tiny">Coupons</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow"></div>
                    <a class="tf-button style-1 w208" href="{{ route('admin.coupon.add') }}"><i class="icon-plus"></i>Add new</a>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">

                        @if(Session::has('status'))
                        <p class="alert alert-success">{{ Session::get('status') }}</p>
                        @endif

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>Used</th>
                                    <th>Max Uses</th>
                                    <th>Expires</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->id }}</td>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ ucfirst($coupon->type) }}</td>
                                    <td>{{ $coupon->type == 'percent' ? $coupon->value.'%' : number_format($coupon->value,2).'€' }}</td>
                                    <td>{{ $coupon->times_used }}</td>
                                    <td>{{ $coupon->max_uses ?? 'Unlimited' }}</td>
                                    <td>{{ $coupon->expires_at ? \Illuminate\Support\Carbon::parse($coupon->expires_at)->format('Y-m-d') : 'Never' }}</td>
                                    <td>{{ $coupon->active ? 'Active' : 'Disabled' }}</td>
                                    <td>
                                        <div class="list-icon-function">
                                            <form action="{{ route('admin.coupon.toggle',['id'=>$coupon->id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="item edit border-0 bg-transparent" title="Toggle Active">
                                                    <i class="icon-{{ $coupon->active ? 'eye-off' : 'eye' }}"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.coupon.delete',['id'=>$coupon->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="item text-danger delete border-0 bg-transparent">
                                                    <i class="icon-trash-2"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                        {{ $coupons->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function(){
            $('.delete').on('click', function(e){
                e.preventDefault();
                var form = $(this).closest('form');
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this coupon!",
                    type: "warning",
                    buttons: ["No","Yes"],
                    confirmButtonColor: '#dc3545'
                }).then(function(result){
                    if (result) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
