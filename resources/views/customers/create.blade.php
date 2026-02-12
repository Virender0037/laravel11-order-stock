<h1>Create a New Customer</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('customers.store') }}" method="POST">
    @csrf
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}">
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}"/>
    </div>
    <div>
        <label for="phone">Phone:</label>
        <input type="number" name="phone" value="{{ old('phone') }}"/>
    </div>
    <button type="submit">Create Customer</button>
</form>
