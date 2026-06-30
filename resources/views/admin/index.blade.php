@extends('layouts.admin')
@section('content')

                        <div class="main-content-inner">

                            <div class="main-content-wrap">
                                <div class="tf-section-2 mb-30">
                                    <div class="flex gap20 flex-wrap-mobile">
                                        <div class="w-half">

                                            <div class="wg-chart-default mb-20 virtuous-stat-card">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap14">
                                                        <div class="image ic-bg virtuous-stat-icon">
                                                            <i class="icon-shopping-bag"></i>
                                                        </div>
                                                        <div>
                                                            <div class="body-text mb-2">Total Community Orders</div>
                                                            <h4 class="virtuous-stat-number">{{ $total_orders }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="wg-chart-default mb-20 virtuous-stat-card">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap14">
                                                        <div class="image ic-bg virtuous-stat-icon">
                                                            <i class="icon-dollar-sign"></i>
                                                        </div>
                                                        <div>
                                                            <div class="body-text mb-2">Total Empowerment Revenue</div>
                                                            <h4 class="virtuous-stat-number">${{ number_format($total_revenue, 2) }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="wg-chart-default mb-20 virtuous-stat-card">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap14">
                                                        <div class="image ic-bg virtuous-stat-icon">
                                                            <i class="icon-shopping-bag"></i>
                                                        </div>
                                                        <div>
                                                            <div class="body-text mb-2">Pending Sisterhood Orders</div>
                                                            <h4 class="virtuous-stat-number">{{ $pending_orders }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="wg-chart-default virtuous-stat-card">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap14">
                                                        <div class="image ic-bg virtuous-stat-icon">
                                                            <i class="icon-dollar-sign"></i>
                                                        </div>
                                                        <div>
                                                            <div class="body-text mb-2">Pending Revenue</div>
                                                            <h4 class="virtuous-stat-number">${{ number_format($pending_revenue, 2) }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="w-half">

                                            <div class="wg-chart-default mb-20 virtuous-stat-card">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap14">
                                                        <div class="image ic-bg virtuous-stat-icon">
                                                            <i class="icon-shopping-bag"></i>
                                                        </div>
                                                        <div>
                                                            <div class="body-text mb-2">Delivered with Love</div>
                                                            <h4 class="virtuous-stat-number">{{ $delivered_orders }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="wg-chart-default mb-20 virtuous-stat-card">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap14">
                                                        <div class="image ic-bg virtuous-stat-icon">
                                                            <i class="icon-dollar-sign"></i>
                                                        </div>
                                                        <div>
                                                            <div class="body-text mb-2">Delivered Revenue</div>
                                                            <h4 class="virtuous-stat-number">${{ number_format($delivered_revenue, 2) }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="wg-chart-default mb-20 virtuous-stat-card">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap14">
                                                        <div class="image ic-bg virtuous-stat-icon">
                                                            <i class="icon-shopping-bag"></i>
                                                        </div>
                                                        <div>
                                                            <div class="body-text mb-2">Canceled Orders</div>
                                                            <h4 class="virtuous-stat-number">{{ $cancelled_orders }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="wg-chart-default virtuous-stat-card">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap14">
                                                        <div class="image ic-bg virtuous-stat-icon">
                                                            <i class="icon-dollar-sign"></i>
                                                        </div>
                                                        <div>
                                                            <div class="body-text mb-2">Canceled Amount</div>
                                                            <h4 class="virtuous-stat-number">${{ number_format($cancelled_revenue, 2) }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="wg-box virtuous-chart-box">
                                        <div class="flex items-center justify-between">
                                            <h5 class="virtuous-chart-title">Empowerment Revenue</h5>
                                            <div class="dropdown default">
                                                <button class="btn btn-secondary dropdown-toggle virtuous-dropdown-btn" type="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <span class="icon-more"><i class="icon-more-horizontal"></i></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end virtuous-dropdown-menu">
                                                    <li>
                                                        <a href="javascript:void(0);">This Week</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Last Week</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap gap40">
                                            <div>
                                                <div class="mb-2">
                                                    <div class="block-legend">
                                                        <div class="dot t1 virtuous-legend-dot"></div>
                                                        <div class="text-tiny">Total Revenue</div>
                                                    </div>
                                                </div>
                                                <div class="flex items-center gap10">
                                                    <h4 class="virtuous-revenue-number">${{ number_format($total_revenue, 2) }}</h4>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="mb-2">
                                                    <div class="block-legend">
                                                        <div class="dot t2 virtuous-legend-dot"></div>
                                                        <div class="text-tiny">Sisterhood Orders</div>
                                                    </div>
                                                </div>
                                                <div class="flex items-center gap10">
                                                    <h4 class="virtuous-revenue-number">{{ $total_orders }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="line-chart-8" class="virtuous-chart"></div>
                                    </div>

                                </div>
                                <div class="tf-section mb-30">

                                    <div class="wg-box virtuous-table-box">
                                        <div class="flex items-center justify-between">
                                            <h5 class="virtuous-table-title">Recent Sisterhood Orders</h5>
                                            <div class="dropdown default">
                                                <a class="btn btn-secondary dropdown-toggle virtuous-view-all-btn" href="{{ route('admin.orders') }}">
                                                    <span class="view-all">View all orders</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="wg-table table-all-user">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered virtuous-table">
                                                    <thead>
                                                        <tr class="virtuous-table-header">
                                                            <th style="width: 80px">Order No</th>
                                                            <th>Sisterhood Member</th>
                                                            <th class="text-center">Contact</th>
                                                            <th class="text-center">Subtotal</th>
                                                            <th class="text-center">Total</th>
                                                            <th class="text-center">Status</th>
                                                            <th class="text-center">Order Date</th>
                                                            <th class="text-center">Items</th>
                                                            <th class="text-center">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($recent_orders as $order)
                                                        <tr class="virtuous-table-row">
                                                            <td class="text-center">{{ $order->order_number }}</td>
                                                            <td class="text-center">{{ $order->name }}</td>
                                                            <td class="text-center">{{ $order->mobile }}</td>
                                                            <td class="text-center">${{ number_format($order->subtotal, 2) }}</td>
                                                            <td class="text-center virtuous-total-amount">${{ number_format($order->total, 2) }}</td>
                                                            <td class="text-center"><span class="virtuous-status ordered">{{ ucfirst($order->status) }}</span></td>
                                                            <td class="text-center">{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                                                            <td class="text-center">{{ $order->items_count }}</td>
                                                            <td class="text-center">
                                                                <a href="{{ route('admin.order.details', $order->id) }}" class="virtuous-action-link">
                                                                    <div class="list-icon-function view-icon">
                                                                        <div class="item eye virtuous-view-icon">
                                                                            <i class="icon-eye"></i>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @empty
                                                        <tr class="virtuous-table-row">
                                                            <td class="text-center" colspan="9">No orders yet.</td>
                                                        </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
@endsection