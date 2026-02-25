<h1>Create a New Product</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <div>
        <label for="sku">sku:</label>
        <input type="text" id="sku" name="sku" value="{{ old('sku') }}">
    </div>
    <div>
        <label for="name">name:</label>
        <input type="name" id="name" name="name" value="{{ old('name') }}"/>
    </div>
    <div>
        <label for="price">price:</label>
        <input type="number" name="price" value="{{ old('price') }}"/>
    </div>
    <div>
        <label for="stock">stock:</label>
        <input type="number" name="stock" value="{{ old('stock') }}"/>
    </div>
    <div>
        <label for="status">status:</label>
        <input type="number" name="phone" value="{{ old('status') }}"/>
    </div>
    <button type="submit">Create Product</button>
</form>
