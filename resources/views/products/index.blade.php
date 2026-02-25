<div>
    <h1>Products Listing</h1>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <div>
    <a href="{{route('products.create')}}" class="btn btn-primary">Create Product</a>
    </div>
    </br>
    <div>
    <a href="{{route('dashboard')}}" class="btn btn-primary">Back</a>
    </div>
    <form action="{{ route('products.index') }}" method="GET">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search products ...." value="{{request('search')}}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>
    <style>
    table, th, td {
    border:1px solid black;
    }
    </style>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>sku</th>
                <th>name</th>
                <th>price</th>
                <th>stock</th>
                <th>status</th>
            </tr>
        </thead>
        @if($products->count())
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->status }}</td>
                    <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                    <form method="POST" action="{{ route('products.destroy', $product->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">
                            Delete
                        </button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        @else
        <p>No product found</p>
        @endif
        </table>
    </div>
     {{$products->withQueryString()->links()}}