@extends('layout.conquer2')
@section('anak2', 'Edit Facilities')

@section('anak')
<div>
    <form action="{{ route('facilities.update', $facility->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $facility->name }}" required>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="productSelect"><span style="color: red">*</span>Product</label>
                    <select class="form-control" name="product_id" id="productSelect">
                        <option disabled selected>Select Product</option>
                        @foreach ($products as $p)
                            <option value="{{ $p->id }}" {{ $p->id == $facility->product_id ? 'selected' : '' }}>{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" rows="4">{{ $facility->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('facilities.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection