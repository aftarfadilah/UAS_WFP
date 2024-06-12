<!-- <html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body> -->

@extends('layout.conquer2')
@section('anak')

    <a class="btn btn-success" href="{{ route('transaction.create') }}">+ new transaction</a>
    <a href="#modalCreate" data-toggle="modal" class="btn btn-info">+ New Type (with Modals)</a>
    @if (@session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    {{-- <a class="btn btn-warning" data-toggle="modal" href="#disclaimer">Disclaimer</a> --}}
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pembeli</th>
                <th>Kasir</th>
                <th>Tanggal Transaction</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $transaksi)
                <tr id="tr_{{ $d->id }}">
                    <td>{{ $transaksi->id }}</td>
                    <td>{{ $transaksi->customer->name }}</td>
                    <td>{{ $transaksi->user->name }}</td>
                    <td>{{ $transaksi->transaction_date }}</td>

                    <td>
                        <a data-toggle="modal" href="#lihat-{{ $transaksi->id }}" class="btn btn-danger">Lihat</a>
                        <a class="btn btn-warning" href="{{ route('transaction.edit', $d->id) }}">Edit</a>
                        <a href="#modalEditA" class="btn btn-warning" data-toggle="modal"
                            onclick="getEditForm({{ $transaksi->id }})">Edit Type A</a>
                        <form method="POST" action="{{ route('transaction.destroy', $d->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="delete" class="btn btn-danger"
                                onclick="return confirm('Are you sure to delete {{ $d->id }} - {{ $d->name }} ? ');">
                        </form>
                        <div class="modal fade" id="lihat-{{ $transaksi->id }}" tabindex="-1" role="basic"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true"></button>
                                        <h4 class="modal-title">Lihat Transaksi</h4>
                                    </div>
                                    <div class="modal-body">
                                        @foreach ($transaksi->products as $p)
                                            <p>You order {{ $p->pivot->quantity }} pcs <u>"{{ $p->name }}"
                                                    from hotel "{{ $p->hotel->name }}"
                                                    with price {{ $p->pivot->subtotal }}</u></p>
                                            <hr>
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if ($transaksi->typeWithTrashed)
                            {{ $transaksi->typeWithTrashed->transaction_date }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
        <br>
    </table>

    <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2 class="modal-title">Add New Type</h2>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('transaction.store') }}">
                        @csrf
                        <h2>Add new Transaction</h2>

                        <div class="form-group">
                            <label for="user">User</label>
                            <select class="form-control" name="user" required>
                                <option value="" selected disabled>Select User</option>
                                @foreach ($users as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="customer">Customer</label>
                            <select class="form-control" name="customer" required>
                                <option value="" selected disabled>Select Customer</option>
                                @foreach ($customers as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <h3>Product</h3>
                        <div class="form-group">
                            <label for="product">Product</label>
                            <select class="form-control" name="product" required>
                                <option value="" selected disabled>Select Product</option>
                                @foreach ($products as $p)
                                    <option value="{{ $p->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Product Quantity</label>
                            <input type="text" name="quantity" class="form-control" id="nameCategory"
                                aria-describedby="nameHelp" placeholder="Enter Product Quantity">
                            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
                        </div>
                        <div class="form-group">
                            <label for="name">Subtotal</label>
                            <input type="text" name="subtotal" class="form-control" id="nameCategory"
                                aria-describedby="nameHelp" placeholder="Subtotal">
                            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
                        </div>

                        <a class="btn btn-info" href="{{ route('transaction.index') }}">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="disclaimer" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">DISCLAIMER</h4>
                </div>
                <div class="modal-body">
                    Pictures shown are for illustration purpose only. Actual product may vary due to product enhancement.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="modal fade" id="lihat-produk" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Lihat Produk</h4>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> --}}


    {{-- <!-- <div class="container">
        <div class="row">
            @foreach ($dataku->take(3) as $hotel)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $hotel->name }}</h5>
                        <p class="card-text">{{ $hotel->address }}, {{ $hotel->postcode }}</p>
                        <p class="card-text">Tipe: {{ $hotel->type_id }}</p>
                        @if ($hotel->products)
                        <ul class="list-group list-group-flush">
                            @foreach ($hotel->products as $product)
                            <img src="{{ asset('images/'.$product->image) }}" class="card-img-top" alt="{{ $hotel->name }}">
                            <li class="list-group-item">{{ $product->name }} - ${{ $product->price }}</li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div> --> --}}

@endsection
@section('anak2', 'Daftar Transaksi')
@section('anak3', 'Halaman Daftar Transaksi')

@section('javascript')
    <script>
        function getEditForm(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('transaction.getEditForm') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id
                },
                success: function(data) {
                    $('#modalContent').html(data.msg)
                }
            });
        }

        function deleteDataRemoveTR(transaction_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('transaction.deleteData') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': transaction_id
                },
                success: function(data) {
                    if (data.status == "oke") {
                        $('#tr_' + transaction_id).remove();
                    }
                }
            });
        }
    </script>
@endsection

@section('transaction')
    <script>
        $('.tombol-produk').click(function() {
            var idHotel = $(this).attr('data-id')
            // alert('masuk guys, id hotel = ' + idHotel);
            $.ajax({
                type: 'GET',
                url: '{{ url('/tampilproduk/') }}/' + idHotel,
                success: function(data) {
                    $('.coba').html(data.msg)
                }
            });

        })
    </script>
@endsection


<!-- </body>
    
    </html> -->
