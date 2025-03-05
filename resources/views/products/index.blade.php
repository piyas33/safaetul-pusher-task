<!DOCTYPE html>
<html>
<head>
    <title>Real-Time Product Display</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // Initialize Pusher
        const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            encrypted: true
        });

        // Subscribe to the channel
        const channel = pusher.subscribe('products');

        // Listen for the ProductUpdated event
        channel.bind('App\\Events\\ProductUpdated', function(data) {
            const product = data.product;
            const productList = document.getElementById('product-list');
            const newProduct = document.createElement('li');
            newProduct.innerHTML = `
                <strong>${product.name}</strong><br>
                ${product.description}<br>
                $${product.price}
            `;
            productList.appendChild(newProduct);
        });
    </script>
</head>
<body>
<h1>Products</h1>
<ul id="product-list">
    @foreach ($products as $product)
        <li>
            <strong>{{ $product->name }}</strong><br>
            {{ $product->description }}<br>
            ${{ $product->price }}
        </li>
    @endforeach
</ul>
</body>
</html>
