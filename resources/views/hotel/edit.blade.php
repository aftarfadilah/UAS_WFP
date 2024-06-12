@extends('layout.conquer2')

@section('anak')

<form method="POST" action="{{ route('hotel.update', $data->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="inputType">Hotel Name</label>
        <input name="nameType" type="text" class="form-control" id="typeInput" aria-describedby="nameHelp" placeholder="Enter name">
        <small id="nameHelp" class="form-text text-muted">We'll never share your name with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="inputType">Address</label>
        <input name="addressType" type="text" class="form-control" id="typeInput" aria-describedby="addressHelp" placeholder="Enter address">
        <small id="addressHelp" class="form-text text-muted">We'll never share your address with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="inputType">City</label>
        <input name="cityType" type="text" class="form-control" id="typeInput" aria-describedby="cityHelp" placeholder="Enter city">
        <small id="cityHelp" class="form-text text-muted">We'll never share your city with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="inputType">State</label>
        <input name="stateType" type="text" class="form-control" id="typeInput" aria-describedby="stateHelp" placeholder="Enter state">
        <small id="stateHelp" class="form-text text-muted">We'll never share your state with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="inputType">Country Id</label>
        <input name="countryType" type="text" class="form-control" id="typeInput" aria-describedby="countryHelp" placeholder="Enter Country Id">
        <small id="countryHelp" class="form-text text-muted">We'll never share your Country id with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="inputType">Email</label>
        <input name="emailType" type="text" class="form-control" id="typeInput" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="inputType">Accommodation Type</label>
        <input name="accommodationType" type="text" class="form-control" id="typeInput" aria-describedby="accommodationHelp" placeholder="Enter Accommodation Type">
        <small id="accommodationHelp" class="form-text text-muted">We'll never share your accommodation type with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="inputType">Category</label>
        <input name="categoryType" type="text" class="form-control" id="typeInput" aria-describedby="categoryHelp" placeholder="Enter Category">
        <small id="categoryHelp" class="form-text text-muted">We'll never share your Category with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="type_id">Hotel Type</label>
        <select class="form-control" name="type">
            @foreach ($types as $t)
                <option 
                @if ($t->id == $data->type_id)
                    selected
                @endif
                value="{{$t->id}}">{{ $t->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>


@endsection