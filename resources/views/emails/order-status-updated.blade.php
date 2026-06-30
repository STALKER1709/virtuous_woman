<x-mail::message>
# Your order status has changed

Order **{{ $order->order_number }}** is now: **{{ ucfirst($order->status) }}**.

<x-mail::button :url="route('user.order.details', $order->order_number)">
View Order
</x-mail::button>

Thank you for shopping with {{ config('app.name') }}.
</x-mail::message>
