<div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<h1>Edit Customer</h1>
<form method="POST" action="{{ route('products.update', $product) }}">
    @csrf
    @method('PUT')

    @if($errors->any())
    @foreach($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
    {{$error}}
    </div>
    @endforeach
    @endif

    <div>
        <label for="sku">sku:</label>
        <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku) }}">
    </div>
    <div>
        <label for="name">name:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}"/>
    </div>
    <div>
        <label for="price">price:</label>
        <input type="number" name="price" value="{{ old('price', $product->price) }}"/>
    </div>
    <div>
        <label for="stock">stock:</label>
        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"/>
    </div>
    <div>
    <label for="status">Status:</label>
    <select name="status">
        <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>
            Active
        </option>
        <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>
            Inactive
        </option>
    </select>
    </div>

    <button type="submit">Update Product</button>
    <a href="{{ route('products.index') }}">Cancel</a>
</form>
</div>
