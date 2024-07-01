@extends('layout.conquer2')

@section('anak2', 'Create Hotel')
@section('anak3', 'Create Hotel Page')

@section('anak')
<form method="POST" action="{{ route('hotel.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="nameInput"><span style="color: red">*</span>Hotel Name</label>
        <input name="nameType" type="text" class="form-control" id="nameInput" placeholder="Enter name">
    </div>
    <div class="form-group">
        <label for="typeInput"><span style="color: red">*</span>Hotel Type</label>
        <select class="form-control" name="hotel_type_id" id="typeInput">
            @foreach ($types as $t)
                <option value="{{ $t->id }}">{{ $t->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="starInput"><span style="color: red">*</span>Logo</label>
                <input name="logo" type="file" class="form-control" id="logoInput">
            </div>            
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label for="imageInput"><span style="color: red">*</span>Image</label>
                <input name="image" type="file" class="form-control" id="imageInput" multiple>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="addressInput"><span style="color: red">*</span>Address</label>
                <input name="addressType" type="text" class="form-control" id="addressInput" placeholder="Enter address">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="stateInput"><span style="color: red">*</span>State</label>
                <input name="stateType" type="text" class="form-control" id="stateInput" placeholder="Enter state">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="postcodeInput"><span style="color: red">*</span>Postcode</label>
                <input name="postcode" type="text" class="form-control" id="postcodeInput" placeholder="Enter Postcode">
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label for="cityInput"><span style="color: red">*</span>City</label>
                <input name="cityType" type="text" class="form-control" id="cityInput" placeholder="Enter city">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="emailInput"><span style="color: red">*</span>Email</label>
                <input name="emailType" type="email" class="form-control" id="emailInput" placeholder="Enter email">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="webInput">Website</label>
                <input name="web" type="url" class="form-control" id="webInput" placeholder="Enter Website URL">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="phoneInput">Phone</label>
                <input name="phone" type="text" class="form-control" id="phoneInput" placeholder="Enter Phone Number">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="faxInput">Fax</label>
                <input name="fax" type="text" class="form-control" id="faxInput" placeholder="Enter Fax Number">
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection