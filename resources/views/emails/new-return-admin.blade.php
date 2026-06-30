<x-mail::message>
# New return request

Order **{{ $return->order->order_number }}** &middot; Customer: {{ $return->user->name }} ({{ $return->user->email }})

**Reason:** {{ $return->reason }}

<x-mail::button :url="route('admin.returns')">
Review Returns
</x-mail::button>
</x-mail::message>
