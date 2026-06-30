<x-mail::message>
# New order received

Order **{{ $order->order_number }}** was placed by {{ $order->name }} ({{ $order->email }}).

<x-mail::table>
| Product | Qty | Price |
| :------ | :-: | ----: |
@foreach ($order->items as $item)
| {{ $item->name }} | {{ $item->quantity }} | {{ number_format($item->price, 2) }}€ |
@endforeach
</x-mail::table>

**Total:** {{ number_format($order->total, 2) }}€
**Payment method:** {{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Bank Transfer' }}

<x-mail::button :url="route('admin.order.details', $order->id)">
View in Admin
</x-mail::button>
</x-mail::message>
