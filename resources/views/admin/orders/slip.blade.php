<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KOT - Order #{{ $order->id }}</title>
    <style>
        body {
            font-family: monospace;
            color: #000;
            background: #fff;
            margin: 0;
            padding: 20px;
            font-size: 14px;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        .border-bottom { border-bottom: 1px dashed #000; margin-bottom: 10px; padding-bottom: 10px; }
        .mb-2 { margin-bottom: 10px; }
        .flex { display: flex; justify-content: space-between; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 10px; }
        th, td { text-align: left; padding: 5px 0; border-bottom: 1px dotted #ccc; }
        th.right, td.right { text-align: right; }
        .btn-print {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background: #000;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border: 1px solid #000;
            font-weight: bold;
            border-radius: 4px;
        }
        .badge-paid { background: #000; color: #fff; }
        @media print {
            .btn-print { display: none; }
            body { padding: 0; margin: 0; }
        }
    </style>
</head>
<body>
    <button class="btn-print" onclick="window.print()">Print Slip</button>
    <div style="max-width: 400px; margin: 0 auto; border: 1px solid #000; padding: 15px;">
        <h1 class="text-center font-bold" style="margin: 0; font-size: 24px;">KITCHEN ORDER TICKET</h1>
        <div class="text-center mb-2" style="font-size: 18px; margin-top: 10px;">BONGS BIRYANI</div>
        <div class="border-bottom text-center">
            Order #{{ $order->id }}<br>
            {{ $order->created_at->format('d M Y, h:i A') }}
        </div>
        
        <div class="mb-2">
            <div class="flex">
                <span><strong>Type:</strong> {{ strtoupper(str_replace('_', '-', $order->order_type)) }}</span>
                @if($order->order_type === 'dine_in')
                    <span><strong>Table:</strong> {{ $order->table_no }}</span>
                @endif
            </div>
            <div class="flex mt-1" style="margin-top: 5px;">
                <span><strong>Customer:</strong> {{ $order->shipping_name ?? ($order->user->name ?? 'Guest') }}</span>
                @if($order->shipping_phone)
                <span><strong>Phone:</strong> {{ $order->shipping_phone }}</span>
                @endif
            </div>
            @if($order->order_type === 'delivery')
                <div style="margin-top: 5px;">
                    <strong>Address:</strong><br>
                    {{ $order->shipping_address }}, {{ $order->shipping_city }} - {{ $order->shipping_pincode }}
                </div>
            @endif
        </div>

        <div class="border-bottom"></div>

        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="right">Qty</th>
                    <th class="right">Price</th>
                    <th class="right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Item' }}</td>
                    <td class="right">{{ $item->quantity }}</td>
                    <td class="right">{{ number_format($item->price, 2) }}</td>
                    <td class="right">{{ number_format($item->quantity * $item->price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex font-bold" style="font-size: 16px; margin-top: 10px;">
            <span>TOTAL AMOUNT</span>
            <span>Rs. {{ number_format($order->total_amount, 2) }}</span>
        </div>
        
        <div class="border-bottom" style="margin-top: 10px;"></div>

        <div class="text-center mt-2" style="margin-top: 15px;">
            <div style="margin-bottom: 5px;">
                <strong>Payment:</strong> {{ strtoupper($order->payment_method ?? 'N/A') }}
            </div>
            <div>
                @if($order->payment_status === 'paid' || $order->status === 'delivered')
                    <span class="badge badge-paid">PAID</span>
                @else
                    <span class="badge">PAYMENT PENDING</span>
                @endif
            </div>
        </div>
        
        <div class="text-center mt-2" style="margin-top: 20px; font-size: 12px;">
            ~ Thank you for ordering from Bongs Biryani ~
        </div>
    </div>
</body>
</html>
