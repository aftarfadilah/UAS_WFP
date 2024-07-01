@extends('layout.conquer2')

@section('anak')

<form method="POST" action="{{ route('type.store') }}">
    @csrf
    <div class="form-group">
        <label for="inputType">Type Name</label>
        <input name="nameType" type="text" class="form-control" id="typeInput" aria-describedby="typeHelp" placeholder="Enter type">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


@endsection