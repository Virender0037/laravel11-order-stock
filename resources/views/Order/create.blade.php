<h1>Create a New Order</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('orders.store') }}" method="POST">
    @csrf
    <div>
        <label for="order_no">Order:</label>
        <input type="number" id="order_no" name="order_no" value="{{ old('order_no') }}">
    </div>
   <div>
        <label for="status">Status:</label>
        <select name="status">
            <option value="active" {{ old('status') == 'pending' ? 'selected' : '' }}>
                Pending
            </option>
            <option value="inactive" {{ old('status') == 'confirmed' ? 'selected' : '' }}>
                Confirmed
            </option>
            <option value="inactive" {{ old('status') == 'cancelled' ? 'selected' : '' }}>
                Cancelled
            </option>
        </select>
    </div>
    <div>
        <label for="total_amount">Total Amount:</label>
        <input type="number" name="total_amount" value="{{ old('total_amount') }}"/>
    </div>
    <button type="submit">Create Order</button>
</form>
