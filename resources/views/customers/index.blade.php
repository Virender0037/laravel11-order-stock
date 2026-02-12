<div>
    <h1>Customers Listing</h1>
    <a href="{{route('customers.create')}}" class="btn btn-primary">Create Customer</a>
    <div>
    <a href="{{route('dashboard')}}" class="btn btn-primary">Back</a>
    </div>
    <form action="{{ route('customers.index') }}" method="GET">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search customers ...." value="{{request('search')}}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>
    <style>
    table, th, td {
    border:1px solid black;
    }
    </style>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>email</th>
                <th>phone</th>
                <th>Action</th>
            </tr>
        </thead>
        @if($customers->count())
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>
                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary">Edit</a>
                    <form method="POST" action="{{ route('customers.destroy', $customer->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this customer?');">
                            Delete
                        </button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        @else
        <p>No customer found</p>
        @endif
        </table>
    </div>