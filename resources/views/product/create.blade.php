@extends('layout.conquer2')
@section('anak2', 'Add new Product')
@section('anak')
    <form method="POST" action="{{ route('product.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                        placeholder="Enter name of Product">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="hotel">Hotel of Product</label>
                    <select class="form-control" name="hotel">
                        <option value="" selected disabled>Select Hotel</option>
                        @foreach ($hotels as $h)
                            <option value="{{ $h->id }}">{{ $h->name }}</option>
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
                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name">Available Room</label>
                    <input type="text" name="available_room" class="form-control" id="nameCategory" aria-describedby="nameHelp"
                        placeholder="Enter Available Room">
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="name">Price</label>
                    <input type="text" name="price" class="form-control" id="nameCategory" aria-describedby="nameHelp" placeholder="Enter price of Product">
                </div>
            </div>
        </div>
        <a class="btn btn-default" href="{{ route('product.index') }}">Cancel</a>
        <button type="submit" class="btn btn-primary" style="padding: 5px 36px">Submit</button>
    </form>
@endsection