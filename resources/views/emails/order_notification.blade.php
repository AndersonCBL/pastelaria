<!DOCTYPE html>
<html>
<head>
    <title>Order Created</title>
</head>
<body>
<h1>Seu Pedido foi Criado</h1>
<p>Detalhes do Pedido:</p>
<ul>
    <li>ID do Pedido: {{ $order->id }}</li>
    <li>Cliente: {{ $order->customer->name }}</li>
    <li>Data do Pedido: {{ $order->created_at->format('d/m/Y H:i') }}</li>
</ul>
<p>Produtos:</p>
<ul>
    @foreach ($order->products as $product)
        <li>{{ $product->name }} - R$ {{ number_format($product->price, 2, ',', '.') }}</li>
    @endforeach
</ul>
<p>Obrigado por comprar conosco!</p>
</body>
</html>
