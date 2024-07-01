@extends('layout.conquer2')

@section('anak')

<form method="POST" action="{{ route('hotel.store') }}">
    @csrf
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
    <label for="postcodeInput">Postcode</label>
    <input name="postcode" type="text" class="form-control" id="postcodeInput" aria-describedby="postcodeHelp" placeholder="Enter Postcode">
    <small id="postcodeHelp" class="form-text text-muted">We'll never share your postcode with anyone else.</small>
</div>

<div class="form-group">
    <label for="longitudeInput">Longitude</label>
    <input name="longitude" type="text" class="form-control" id="longitudeInput" aria-describedby="longitudeHelp" placeholder="Enter Longitude">
    <small id="longitudeHelp" class="form-text text-muted">We'll never share your longitude with anyone else.</small>
</div>

<div class="form-group">
    <label for="latitudeInput">Latitude</label>
    <input name="latitude" type="text" class="form-control" id="latitudeInput" aria-describedby="latitudeHelp" placeholder="Enter Latitude">
    <small id="latitudeHelp" class="form-text text-muted">We'll never share your latitude with anyone else.</small>
</div>

<div class="form-group">
    <label for="partnerReferenceInput">Partner Reference</label>
    <input name="partner_reference" type="text" class="form-control" id="partnerReferenceInput" aria-describedby="partnerReferenceHelp" placeholder="Enter Partner Reference">
    <small id="partnerReferenceHelp" class="form-text text-muted">We'll never share your partner reference with anyone else.</small>
</div>

<div class="form-group">
    <label for="phoneInput">Phone</label>
    <input name="phone" type="text" class="form-control" id="phoneInput" aria-describedby="phoneHelp" placeholder="Enter Phone Number">
    <small id="phoneHelp" class="form-text text-muted">We'll never share your phone number with anyone else.</small>
</div>

<div class="form-group">
    <label for="imageInput">Image</label>
    <input name="image" type="file" class="form-control" id="imageInput" aria-describedby="imageHelp">
    <small id="imageHelp" class="form-text text-muted">Upload an image for the hotel.</small>
</div>

<div class="form-group">
    <label for="webInput">Website</label>
    <input name="web" type="url" class="form-control" id="webInput" aria-describedby="webHelp" placeholder="Enter Website URL">
    <small id="webHelp" class="form-text text-muted">Enter the hotel's website URL.</small>
</div>

<div class="form-group">
    <label for="currencyInput">Currency</label>
    <input name="currency" type="text" class="form-control" id="currencyInput" aria-describedby="currencyHelp" placeholder="Enter Currency">
    <small id="currencyHelp" class="form-text text-muted">Enter the currency used by the hotel.</small>
</div>

<div class="form-group">
    <label for="faxInput">Fax</label>
    <input name="fax" type="text" class="form-control" id="faxInput" aria-describedby="faxHelp" placeholder="Enter Fax Number">
    <small id="faxHelp" class="form-text text-muted">Enter the hotel's fax number.</small>
</div>


    <div class="form-group">
        <label for="type_id">Hotel Type</label>
        <select class="form-control" name="type_id">
            @foreach ($types as $t)
                <option value="{{$t->id}}">{{ $t->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>


@endsection