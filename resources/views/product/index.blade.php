@extends('layout.conquer2')
@section('anak2', 'Products')
@section('anak')
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
        <div class="container-fluid">
            <div class="row">
                @foreach ($products as $p)
                    <div class="col-md-4">
                        <div class="thumbnail">
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
                            <div class="caption">
                                <h3>{{ $p->name }}</h3>
                                        
                                <p class="card-text">{{ $p->tipe_kamar }}</p>
                                <small class="text-muted">Price: {{ $p->price }}</small>
                                <br><br>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('product.edit', $p->id) }}">Edit</a></li>
                                            <li><a href="{{ url('product/uploadPhoto/'.$p->id) }}">upload photo</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li>
                                                @if($p->filenames)
                                                    <form method="POST" style="display: inline" action="{{url('product/delPhoto')}}">
                                                        @csrf
                                                        <input type="hidden" value="{{'product/'.$p->id.'/'.$filename}}" name='filepath' />
                                                        <input type="submit" value="Delete Photo" class="text-danger" onclick="return confirm('Are you sure ? ');">
                                                    </form>
                                                @endif
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <form method="POST" style="display: inline" action="{{ route('product.destroy', $p->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                        <input type="submit" value="delete" class="text-danger" onclick="return confirm('Are you sure to delete {{ $p->id }} - {{ $p->name }} ? ');" style="background-color: transparent; border:none;">
                                                    </form>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="d-flex btn-group">
                                    </div>
                                </div>
                            </div>
                        </div>
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
