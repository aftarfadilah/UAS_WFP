@extends('layout.conquer2')
@section('anak2', 'Create Facilities')

@section('anak')
<div>
    <h1>Create Facility</h1>
    <form action="{{ route('facilities.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name"><span style="color: red">*</span>Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Facility Name" required>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="productSelect"><span style="color: red">*</span>Product</label>
                    <select class="form-control" name="product_id" id="productSelect">
                        <option disabled selected>Select Product</option>
                        @foreach ($products as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" rows="4" placeholder="Lorem Ipsum dolor sit amet..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('facilities.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection