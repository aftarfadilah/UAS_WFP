@extends('layout.conquer2')

@section('anak')
    <form method="POST" action="{{ route('product.update', $data->id) }}">
        @csrf
        @method('PUT')
        <h2>Add new Product</h2>
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter name of Product" value="{{ $data->name }}">
            <small id="nameHelp" class="form-text text-muted">Enter product name</small>
        </div>
        <div class="form-group">
            <label for="name">Product Price</label>
            <input type="text" name="price" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter Price of Product" value="{{ $data->price }}">
            <small id="nameHelp" class="form-text text-muted">Enter price of product</small>
        </div>
        <div class="form-group">
            <label for="name">Product Image</label>
            <input type="text" name="image" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter Image of Product" value="{{ $data->image }}">
            <small id="nameHelp" class="form-text text-muted">Enter image product</small>
        </div>
        <div class="form-group">
            <label for="name">Product Type</label>
            <input type="text" name="tipe_kamar" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter product type" value="{{ $data->tipe_kamar }}">
            <small id="nameHelp" class="form-text text-muted">Enter product type</small>
        </div>
        <div class="form-group">
            <label for="name">available_room of Product</label>
            <input type="text" name="room" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                placeholder="Enter available_room of Product" value="{{ $data->available_room }}">
            <small id="nameHelp" class="form-text text-muted">Enter available room</small>
        </div>
        <div class="form-group">
            <label for="name">Hotel of Product</label>
            
        </div>
        <a class="btn btn-info" href="{{ route('product.index') }}">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection