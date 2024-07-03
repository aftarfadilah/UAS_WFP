@extends('layout.conquer2')

@section('anak')
    <form method="GET" action="{{ route('customer.store') }}">
        @csrf
        @method('PUT')
        <h2>Add new Customer</h2>
        <div class="form-group">
            <label for="name">Customer Name</label>
            <input type="text" name="name" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter customer name" value="{{$data->name}}">
            <small id="nameHelp" class="form-text text-muted">Enter your name</small>
        </div>
        <div class="form-group">
            <label for="name">Customer Address</label>
            <input type="text" name="address" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter Customer address" value="{{$data->address}}">
            <small id="nameHelp" class="form-text text-muted">Enter your address</small>
        </div>
        <a class="btn btn-info" href="{{ url()->previous() }}">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection