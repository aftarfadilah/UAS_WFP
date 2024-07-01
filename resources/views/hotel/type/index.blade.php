@extends('layout.conquer2')
@section('anak2', 'Hotel Types')
@section('anak')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <a href="#modalCreate" data-toggle="modal" class="btn btn-info">+ New Type</a>

    <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add New Type</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('hotel.type.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="inputType">Type Name</label>
                            <input name="nameType" type="text" class="form-control" id="typeInput"
                                aria-describedby="typeHelp" placeholder="Enter type">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-wide">
            <div class="modal-content">
                <div class="modal-body" id="modalContent">
                    {{-- You can put animated loading image here... --}}
                </div>
            </div>
        </div>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>    
            @foreach ($data as $types)
                <tr id="tr_{{ $types->id }}">
                    <td id="td_name_{{ $types->id }}">{{ $types->name }}</td>
                    <td>
                        <a href="#modalEdit" class="btn btn-primary" data-toggle="modal" onclick="getEditForm({{ $types->id }})">Edit</a>
                        <form method="POST" action="{{ route('hotel.type.destroy', $types->id) }}" style="display: inline" class="btn btn-danger">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" onclick="return confirm('Are you sure to delete {{ $types->id }} - {{ $types->name }} ? ');" style="background-color: transparent; border: none; padding: 0">
                        </form>
                    </td>
                    <td>
                        @if ($types->typeWithTrashed)
                            {{ $types->typeWithTrashed->name }}
                        @endif
                    </td>
                </tr>
            @endforeach
    </table>
@endsection




@section('javascript')
    <script>
        function getEditForm(id) {
            $.ajax({
                type: 'POST',
                url: "{{ route('hotel.type.getEditForm') }}",
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id
                },
                success: function(data) {
                    $('#modalContent').html(data.msg)
                }
            });
        }

        function deleteDataRemoveTR(type_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('hotel.type.deleteData') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': type_id
                },
                success: function(data) {
                    if (data.status == "oke") {
                        $('#tr_' + type_id).remove();
                    }
                }
            });
        }

        function saveDataUpdateTD(type_id) {
            var eName = $('#eName').val();
            console.log(eName); //debug->print to browser console
            $.ajax({
                type: 'POST',
                url: '{{ route('hotel.type.saveDataTD') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': type_id,
                    'name': eName
                },
                success: function(data) {
                    if (data.status == "oke") {
                        $('#td_name_' + type_id).html(eName);
                        $('#modalEditB').modal('hide');
                    }
                }
            })
        }
    </script>
@endsection
