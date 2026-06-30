<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; font-size: 13px; color: #222; }
        h1 { font-size: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 6px 8px; text-align: left; }
        th { background: #f5f5f5; }
        .totals td { border: none; }
        .totals { width: 40%; margin-left: auto; margin-top: 10px; }
        .header { display: flex; justify-content: space-between; }
    </style>
</head>
<body>
    <h1>{{ config('app.name') }}</h1>
    <p>Invoice / Facture: <strong>{{ $order->order_number }}</strong><br>
    Date: {{ $order->created_at->format('d/m/Y') }}</p>

    <p>
        <strong>{{ $order->name }}</strong><br>
        {{ $order->address }}<br>
        {{ $order->city }}, {{ $order->zip }}<br>
        {{ $order->country }}<br>
        {{ $order->email }}
    </p>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ number_format($item->price, 2) }}€</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price * $item->quantity, 2) }}€</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totals">
        <tr><td>Subtotal</td><td>{{ number_format($order->subtotal, 2) }}€</td></tr>
        @if ($order->discount > 0)
            <tr><td>Discount</td><td>-{{ number_format($order->discount, 2) }}€</td></tr>
        @endif
        <tr><td>Shipping</td><td>{{ number_format($order->shipping, 2) }}€</td></tr>
        <tr><td>VAT ({{ $order->vat_rate }}%, included)</td><td>{{ number_format($order->vat_amount, 2) }}€</td></tr>
        <tr><td><strong>Total</strong></td><td><strong>{{ number_format($order->total, 2) }}€</strong></td></tr>
    </table>

    <p style="margin-top:30px;">Payment method: {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
</body>
</html>
