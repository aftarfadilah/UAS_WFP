<form method="POST" action="{{ route('hotel.type.update', $data->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="inputType">Type Name</label>
        <input name="nameType" type="text" value="{{$data->name}}" class="form-control" id="typeInput" aria-describedby="typeHelp" placeholder="Enter type">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>