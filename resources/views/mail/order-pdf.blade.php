<!doctype html>
<html>
<head>
    <meta charset="utf-8">
</head>

<body>
<div style="width:100%">
    <div style="font-weight: bold; font-size: 22px;display:inline-block;width: 50%">
        {!! config('app.name') !!}
    </div>

    <div style="display:inline-block;width: 49%;text-align:right">
        Pedido # : {{ $order->id }} <br/>
    </div>

</div>

<div style="width:100%">
    <div style="display:inline-block;width: 49%;text-align:left">
        <?php $shippingAddress = $order->shipping_address ?>
        <h4>Endereço de Entrega </h4>
        {{ $shippingAddress->address1 }}<br/>
        {{ $shippingAddress->address2 }}<br/>
        {{ $shippingAddress->area }}<br/>
        {{ $shippingAddress->city }}<br/>
        {{ $shippingAddress->state }}<br/>
        {{ $shippingAddress->counry }}<br/>

    </div>
    <div style="display:inline-block;width: 49%;text-align:left">
        <?php $billingAddress = $order->billing_address ?>
        <h4>Endereço de Cobrança </h4>
        {{ $billingAddress->address1 }}<br/>
        {{ $billingAddress->address2 }}<br/>
        {{ $billingAddress->area }}<br/>
        {{ $billingAddress->city }}<br/>
        {{ $billingAddress->state }}<br/>
        {{ $billingAddress->counry }}<br/>
    </div>
</div>


<div style="height:50px">

</div>

<div style="width:100%">
    <table style="width: 100%">
        <tr>
            <th style="text-align:left"> Produto</th>
            <th style="text-align:left"> Preço</th>
            <th style="text-align:left"> Qtd</th>
            <th style="text-align:left"> Total</th>
        </tr>

        @foreach($order->products as $product)
            <tr>
                <td>
                    {{ $product->title }}
                </td>

                <td>
                    ${{ $product->getRelationValue('pivot')->price }}
                </td>
                <td>
                    {{ $product->getRelationValue('pivot')->qty }}
                </td>
                <td>
                    {{ $total = $product->getRelationValue('pivot')->price * $product->getRelationValue('pivot')->qty }}
                </td>
            </tr>
        @endforeach
    </table>
</div>
</body>
</html>
