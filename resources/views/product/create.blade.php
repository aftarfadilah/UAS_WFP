@extends('layout.conquer2')

@section('anak')
    <form method="GET" action="{{ route('product.store') }}">
        @csrf
        <h2>Add new Product</h2>
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter name of Product">
            <small id="nameHelp" class="form-text text-muted">Enter product name</small>
        </div>
        <div class="form-group">
            <label for="name">Product Price</label>
            <input type="text" name="price" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter Price of Product">
            <small id="nameHelp" class="form-text text-muted">Enter price of product</small>
        </div>
        <div class="form-group">
            <label for="name">Product Image</label>
            <input type="text" name="image" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter Image of Product">
            <small id="nameHelp" class="form-text text-muted">Enter image product</small>
        </div>
        <div class="form-group">
            <label for="name">Product Type</label>
            <input type="text" name="desc" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter product type">
            <small id="nameHelp" class="form-text text-muted">Enter product type</small>
        </div>
        <div class="form-group">
            <label for="name">available_room of Product</label>
            <input type="text" name="room" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter available_room of Product">
            <small id="nameHelp" class="form-text text-muted">Enter available room</small>
        </div>
        <div class="form-group">
            <label for="name">Hotel of Product</label>
            <select class="form-control" name="hotel">
                <option value="" selected disabled>Select Hotel</option>
                @foreach ($datas as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                @endforeach
            </select>
        </div>
        <a class="btn btn-info" href="{{ route('product.index') }}">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection