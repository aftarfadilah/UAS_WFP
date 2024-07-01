@extends('layout.conquer2')
@section('anak2', 'Edit Product')


@section('anak')
    <form method="POST" action="{{ route('product.update', $data->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" class="form-control" id="nameCategory" aria-describedby="nameHelp" placeholder="Enter name of Product" value="{{ $data->name }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="hotel">Hotel of Product</label>
                    <select class="form-control" name="hotel">
                        <option disabled selected>Select Hotel</option>
                        @foreach ($hotels as $h)
                            <option value="{{ $h->id }}" {{ $h->id == $data->hotel_id ? 'selected' : '' }}>{{ $h->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control" name="type">
                <option value="" selected disabled>Select Product Type</option>
                @foreach ($types as $t)
                    <option value="{{ $t->id }}"  {{ $t->id == $data->type_id ? 'selected' : '' }}>{{ $t->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name">Available Room</label>
                    <input type="text" name="available_room" class="form-control" id="nameCategory" aria-describedby="nameHelp" placeholder="Enter Available Room" value="{{ $data->available_room }}">
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="name">Price</label>
                    <input type="text" name="price" class="form-control" id="nameCategory" aria-describedby="nameHelp" placeholder="Enter price of Product" value="{{ $data->price }}">
                </div>
            </div>
        </div>
        <a class="btn btn-default" href="{{ route('product.index') }}">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection