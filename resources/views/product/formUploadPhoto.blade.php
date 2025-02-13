@extends('layout.conquer2')
@section('anak')
<div class="page-content">
    <h3 class="page-title">Upload Photo untuk product {{$product->name}}</h3>
    <div class="container">
      <form method="POST" enctype="multipart/form-data" action="{{url('product/simpanPhoto')}}">
          @csrf
          <div class="form-group">
             <label for="exampleInputType">Pilih Logo</label>
             <input type="file" class="form-control" name="file_photo" multiple/>
             <input type="hidden" name='product_id' value="{{$product->id}}"/>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
</div>
@endsection
