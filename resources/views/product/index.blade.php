@extends('layout.conquer2')
@section('anak')

<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Produts</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">
</head>

<body>

    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Produtcs</h1>
                <p class="lead text-muted">Cek</p>
                <a class="btn btn-success" href="{{ route('product.create') }}">+ New Product</a>
                <a href="#modalCreate" data-toggle="modal" class="btn btn-info">+ New Type (with Modals)</a>
                @if (@session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    @foreach ($products as $p)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="card mb-4 shadow-sm" id="tr_{{ $p->id }}">
                                    <!-- <img class="card-img-top" src="{{ asset('images/' . $p->image) }}"> -->
                                    @if($p->filenames)
                                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach ($p->filenames as $filename)
                                                    @if ($loop->first)
                                                        <div class="item active">
                                                            <img src="{{asset('images/product/'.$p->id.'/'.$filename)}}"/>
                                                        </div>
                                                    @endif

                                                    <div class="item">
                                                        <img src="{{asset('images/product/'.$p->id.'/'.$filename)}}"/>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $p->name }}</h5>
                                        <h7>{{ $p->hotel->name }}</h7>
                                        <p class="card-text">{{ $p->tipe_kamar }}</p>
                                        <small class="text-muted">Price: {{ $p->price }}</small>
                                        <br><br>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex btn-group">
                                                <a class="btn btn-sm btn-outline-secondary mr-3" href="{{ route('product.edit', $p->id) }}">Edit</a>
                                                <a href="#modalEditA" class="btn btn-sm btn-outline-secondary mr-3" data-toggle="modal" onclick="getEditForm({{ $p->id }})">Edit Type A</a>
                                                <a href="{{ url('product/uploadPhoto/'.$p->id) }}">
                                                    <button class='btn btn-xs btn-outline-secondary mr-3'>upload photo</button>
                                                </a>
                                                @if($p->filenames)
                                                    <form style="display: inline" method="POST" action="{{url('product/delPhoto')}}">
                                                        @csrf
                                                        <input type="hidden" value="{{'product/'.$p->id.'/'.$filename}}" name='filepath' />
                                                        <input type="submit" value="Delete Photo" class="btn btn-danger btn-xs mr-3" onclick="return confirm('Are you sure ? ');">
                                                    </form>
                                                @endif
                                                <form method="POST" action="{{ route('product.destroy', $p->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="delete"
                                                        class="btn btn-danger btn-xs"
                                                        onclick="return confirm('Are you sure to delete {{ $p->id }} - {{ $p->name }} ? ');">
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <td>
                                @if ($p->typeWithTrashed)
                                    {{ $p->typeWithTrashed->name }}
                                @endif
                            </td>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    {{-- <footer class="text-muted">
        <div class="container">
            <p class="float-right">
                <a href="#">Back to top</a>
            </p>
            <p>Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
            <p>New to Bootstrap? <a href="../../">Visit the homepage</a> or read our <a
                    href="../../getting-started/">getting started guide</a>.</p>
        </div>
    </footer> --}}

    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2 class="modal-title">Add New Product</h2>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('product.store') }}">
                        @csrf
                        <h2>Add new Product</h2>
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" class="form-control" id="nameCategory"
                                aria-describedby="nameHelp" placeholder="Enter name of Product">
                            <small id="nameHelp" class="form-text text-muted">Enter product name</small>
                        </div>
                        <div class="form-group">
                            <label for="name">Product Price</label>
                            <input type="text" name="price" class="form-control" id="nameCategory"
                                aria-describedby="nameHelp" placeholder="Enter Price of Product">
                            <small id="nameHelp" class="form-text text-muted">Enter price of product</small>
                        </div>
                        <div class="form-group">
                            <label for="name">Product Image</label>
                            <input type="text" name="image" class="form-control" id="nameCategory"
                                aria-describedby="nameHelp" placeholder="Enter Image of Product">
                            <small id="nameHelp" class="form-text text-muted">Enter image product</small>
                        </div>
                        <div class="form-group">
                            <label for="name">Product Type</label>
                            <input type="text" name="desc" class="form-control" id="nameCategory"
                                aria-describedby="nameHelp" placeholder="Enter product type">
                            <small id="nameHelp" class="form-text text-muted">Enter product type</small>
                        </div>
                        <div class="form-group">
                            <label for="name">available_room of Product</label>
                            <input type="text" name="room" class="form-control" id="nameCategory"
                                aria-describedby="nameHelp" placeholder="Enter available_room of Product">
                            <small id="nameHelp" class="form-text text-muted">Enter available room</small>
                        </div>
                        <div class="form-group">
                            <label for="name">Hotel of Product</label>
                            <select class="form-control" name="hotel">
                                <option value="" selected disabled>Select Hotel</option>
                                <!--  -->
                            </select>
                        </div>

                        <a class="btn btn-info" href="{{ route('product.index') }}">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection

@section('javascript')
<script>
    function getEditForm(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('product.getEditForm') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id
                },
                success: function(data) {
                    $('#modalContent').html(data.msg)
                }
            });
        }

        function deleteDataRemoveTR(product_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('product.deleteData') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': product_id
                },
                success: function(data) {
                    if (data.status == "oke") {
                        $('#tr_' + product_id).remove();
                    }
                }
            });
        }
</script>
