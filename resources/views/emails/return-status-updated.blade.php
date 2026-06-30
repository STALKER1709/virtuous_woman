<x-mail::message>
# Your return request has been updated

Your return request for order **{{ $return->order->order_number }}** is now: **{{ ucfirst($return->status) }}**.

@if ($return->admin_notes)
**Note from our team:** {{ $return->admin_notes }}
@endif

<x-mail::button :url="route('user.order.details', $return->order->order_number)">
View Order
</x-mail::button>

Thank you for shopping with {{ config('app.name') }}.
</x-mail::message>
