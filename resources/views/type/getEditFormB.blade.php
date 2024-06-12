@extends('layout.conquer2')

@section('anak')

<form method="POST" action="{{ route('type.update', $data->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="inputType">Type Name</label>
        <input name="nameType" type="text" value="{{$data->name}}" class="form-control" id="eName" aria-describedby="typeHelp" placeholder="Enter type">
        <small id="typeHelp" class="form-text text-muted">We'll never share your type name with anyone else.</small>
    </div>

    <button type="button" class="btn btn-primary" onclick="saveDataUpdateTD({{$data->id}})">Submit</button>
</form>


@endsection