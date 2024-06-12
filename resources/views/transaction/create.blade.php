@extends('layout.conquer2')

@section('anak')
    <form method="GET" action="{{ route('transaction.store') }}">
        @csrf
        <h2>Add new Transaction</h2>

        <div class="form-group">
            <label for="user">User</label>
            <select class="form-control" name="user" required>
                <option value="" selected disabled>Select User</option>
                @foreach ($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="customer">Customer</label>
            <select class="form-control" name="customer" required>
                <option value="" selected disabled>Select Customer</option>
                @foreach ($customers as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>

        <h3>Product</h3>
        <div class="form-group">
            <label for="product">Product</label>
            <select class="form-control" name="product" required>
                <option value="" selected disabled>Choose Product</option>
                @foreach ($products as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Product Quantity</label>
            <input type="text" name="quantity" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter Quantity of Product">
            <small id="nameHelp" class="form-text text-muted">Enter your product quantity</small>
        </div>
        <div class="form-group">
            <label for="name">Subtotal of Product</label>
            <input type="text" name="subtotal" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter Subtotal of Product">
            <small id="nameHelp" class="form-text text-muted">Enter subtotal of product</small>
        </div>

        <a class="btn btn-info" href="{{ route('transaction.index') }}">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection