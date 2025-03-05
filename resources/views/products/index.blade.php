<!DOCTYPE html>
<html>
<head>
    <title>Real-Time Product Display</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Pusher JS -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
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

            // Create a new product card
            const newProductCard = `
                <div class="col-lg-4 col-sm-12 pb-2">
                    <div class="card product-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">${product.name}</h5>
                            <p class="card-text">${product.description.substring(0, 100)}...</p>
                            <p class="card-text"><strong>$${product.price}</strong></p>
                        </div>
                    </div>
                </div>
            `;

            // Append the new product card to the product list
            productList.insertAdjacentHTML('beforeend', newProductCard);
        });
    </script>
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .product-card {
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
            display: flex;
            flex-direction: column;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .product-image {
            height: 200px;
            object-fit: cover;
        }
        .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 1.5rem;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 0.75rem;
        }
        .card-text {
            flex-grow: 1;
            color: #555;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        .card-text strong {
            color: #000;
            font-size: 1.1rem;
        }
        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <h1 class="text-center">Real-Time Product Display</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4" id="product-list">
        @foreach ($products as $product)
            <div class="col-lg-4 col-sm-12 pb-2">
                <div class="card product-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                        <p class="card-text"><strong>${{ $product->price }}</strong></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
