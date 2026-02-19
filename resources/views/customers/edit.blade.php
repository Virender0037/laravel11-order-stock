<div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<h1>Edit Customer</h1>
<form method="POST" action="{{ route('customers.update', $customer) }}">
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
        <label for="name">Name:</label>
        <input type="name" id="name" name="name" value="{{ old('name', $customer->name) }}">
    </div>

    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email', $customer->email) }}">
    </div>

    <div>
        <label for="phone">Phone:</label>
        <input type="number" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}">
    </div>

    <button type="submit">Update Customer</button>
    <a href="{{ route('customers.index') }}">Cancel</a>
</form>
</div>
