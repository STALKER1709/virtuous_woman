<x-mail::message>
# Good news!

**{{ $product->name }}** is back in stock.

<x-mail::button :url="route('shop.product.details', $product->slug)">
Shop Now
</x-mail::button>

Thank you for shopping with {{ config('app.name') }}.
</x-mail::message>
