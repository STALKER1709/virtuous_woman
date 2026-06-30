<x-mail::message>
# Thank you for your order, {{ $order->name }}!

Your order **{{ $order->order_number }}** has been placed successfully and is now **{{ ucfirst($order->status) }}**.

<x-mail::table>
| Product | Qty | Price |
| :------ | :-: | ----: |
@foreach ($order->items as $item)
| {{ $item->name }} | {{ $item->quantity }} | {{ number_format($item->price, 2) }}€ |
@endforeach
</x-mail::table>

**Subtotal:** {{ number_format($order->subtotal, 2) }}€
**Shipping:** {{ number_format($order->shipping, 2) }}€
**Total:** {{ number_format($order->total, 2) }}€

Shipping to: {{ $order->address }}, {{ $order->city }}{{ $order->state ? ', '.$order->state : '' }} {{ $order->zip }}, {{ $order->country }}

<x-mail::button :url="route('checkout.confirmation', $order->order_number)">
View Order
</x-mail::button>

Thank you for shopping with {{ config('app.name') }}.
</x-mail::message>
