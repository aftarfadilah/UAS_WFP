@extends('layout.conquer2')

@section('anak')
    <!DOCTYPE html>
    <html lang="en">

    {{-- <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head> --}}

    <body>

        <div class="container">
            <h2>Welcome Page</h2>
            <p>Customer</p>

            <a class="btn btn-success" href="{{ route('customer.create') }}">+ new Type</a>

            @if (@session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Creted</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $c)
                        <tr id="tr_{{ $c->id }}">
                            <td>{{ $c->id }}</td>
                            <td>{{ $c->name }}</td>
                            <td>{{ $c->address }}</td>
                            <td>{{ $c->created_at }}</td>
                            <td>{{ $c->updated_at }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('customer.edit', $c->id) }}">Edit</a>
                                <a href="#modalEditA" class="btn btn-primary" data-toggle="modal"
                                    onclick="getEditForm({{ $c->id }})">Edit Type A</a>
                                <a href="#" value="DeleteNoReload" class="btn btn-danger"
                                    onclick="if(confirm('Are you sure to delete {{ $c->id }} - {{ $c->name }} ? ')) deleteDataRemoveTR({{ $c->id }})">Delete
                                    without Reload</a>
                                <form method="POST" action="{{ route('customer.destroy', $c->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="delete" class="btn btn-danger"
                                        onclick="return confirm('Are you sure to delete {{ $c->id }} - {{ $c->name }} ? ');">
                                </form>
                            </td>
                            <td>
                                @if ($c->typeWithTrashed)
                                    {{ $c->typeWithTrashed->name }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h2 class="modal-title">Add New Customer</h2>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('customer.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Customer Name</label>
                                <input type="text" name="name" class="form-control" id="nameCategory"
                                    aria-describedby="nameHelp" placeholder="Enter customer name">
                                <small id="nameHelp" class="form-text text-muted">Enter your name</small>
                            </div>
                            <div class="form-group">
                                <label for="name">Customer Address</label>
                                <input type="text" name="address" class="form-control" id="nameCategory"
                                    aria-describedby="nameHelp" placeholder="Enter Customer address">
                                <small id="nameHelp" class="form-text text-muted">Enter your address</small>
                            </div>
                            <a class="btn btn-info" href="{{ url()->previous() }}">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </body>

    </html>
@endsection

@section('javascript')
    <script>
        function getEditForm(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('customer.getEditForm') }}'
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id
                },
                success: function(data) {
                    $('#modalContent')
                }
            })
        }

        function deleteDataRemoveTR(customer_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('customer.deleteData') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': customer_id
                },
                success: function(data) {
                    if (data.status == "oke") {
                        $('#tr_' + customer_id).remove();
                    }
                }
            });
        }
    </script>
