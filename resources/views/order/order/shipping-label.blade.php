<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ __('avored::system.order_invoice') }}</title>
</head>

<body>
    <div  style="padding: 30px;border: 1px solid #eee; font-size: 16px;line-height: 24px;width:100%">
        <table cellpadding="0" cellspacing="0" style="width:100%">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td style="font-size: 45px;line-height: 45px;color: #333;padding-bottom: 20px;">
                                AvoRed Shopping Cart
                            </td>
                            
                            <td style="padding-bottom: 20px;text-align:right">
                                {{ __('avored::system.invoice') }} #: {{ $order->id }}<br>
                                {{ __('avored::system.fields.created_at') }}: {{ $order->created_at->format('d-M-Y') }}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table style="width: 100%">
                        <tr>
                            <td style="padding: 5px;">
                                {{ $order->shippingAddress->company_name }}<br>
                                {{ $order->shippingAddress->first_name }} {{ $order->shippingAddress->last_name }}<br>
                                {{ $order->shippingAddress->address1 }}, {{ $order->shippingAddress->address2 }}<br/>
                                {{ $order->shippingAddress->city }} {{ $order->shippingAddress->country->name }}
                                {{ $order->shippingAddress->postcode }}
                            </td>
                            
                            <td style="padding: 5px;text-align:right">
                                {{ $order->billingAddress->company_name }}<br>
                                {{ $order->billingAddress->first_name }} {{ $order->billingAddress->last_name }}<br>
                                {{ $order->customer->email }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td style="background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;padding:5px">
                    {{ __('avored::system.fields.payment_option')}}
                </td>
                
                <td style="background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;padding:5px;text-align:right">
                    {{ $order->payment_option }}
                </td>
            </tr>
            
            <tr class="heading">
                <td style="background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;padding:5px">
                    {{ __('avored::system.fields.name') }}
                </td>
                <td style="background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;padding:5px;text-align:right">
                    {{ __('avored::system.fields.qty') }}
                </td>
            </tr>
           
            @foreach ($order->products as $product)
               
                <tr class="item">
                    <td style="padding:5px">{{ $product->product->name }}</td>
                    <td style="text-align:right">
                        {{ number_format($product->qty, 2) }}
                    </td>
                    
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
