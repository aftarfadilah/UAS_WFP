@extends('layout.conquer2')
@section('anak')
    
@can('create', App\Models\Hotel::class)
<a class="btn btn-primary" href="{{ url('/hotel/create') }}">Create Hotel</a>
@endcan

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Kota</th>
                    <th>Tipe</th>
                    <!-- <th>List Produk</th> -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataku as $hotel)
                    <tr>
                        <td>{{ $hotel->name }}</td>
                        <td>{{ $hotel->address }}</td>
                        <td>{{ $hotel->city }}</td>
                        <td>{{ $hotel->type }}</td>
                        <td>
                    
                        </td>

                        <td>
                            <a class="btn btn-success" data-toggle="modal" href="#lihat-{{ $hotel->id }}">Lihat</a>
                            <a class="btn btn-info tombol-produk" data-toggle="modal"
                                onclick='showProduk({{ $hotel->id }})'>Produk</a>
                            @can('delete-hotel-permission', Auth::user())

                
                            <form id="deleteForm_{{ $hotel->id }}" action="{{ route('hotel.destroy', $hotel->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>

                            <a class="btn btn-danger tombol-produk" href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this hotel?')) document.getElementById('deleteForm_{{ $hotel->id }}').submit();">
                                Hapus
                            </a>

                            @endcan

                            {{-- <a class="btn btn-warning" href="{{route ('hotel.edit', $hotel->id)}}">Edit</a> --}}

                            <div class="modal fade" id="lihat-{{ $hotel->id }}" tabindex="-1" role="basic"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true"></button>
                                            <h4 class="modal-title">{{ $hotel->name }}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ asset('/logo/'.$hotel->id.'.jpg') }}" style="Width:100%" />
                                            <br><br>
                                            <p>Type: {{ $hotel->type->name }}</p>
                                            <p>Address: {{ $hotel->address }}, {{ $hotel->city }}, {{ $hotel->state }} {{ $hotel->postcode }}</p>
                                            <p>Email: {{ $hotel->email }}</p>
                                            <p>Phone: {{ $hotel->phone }}</p>
                                            <p>Website: {{ $hotel->website }}</p>
                                            <p>Fax: {{ $hotel->fax }} </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <form method="POST" action="{{route('hotel.destroy', $hotel->id)}}">Hapus</form> --}}
                        </td>
                        <td>
                            @if ($hotel->typeWithTrashed)
                                {{ $hotel->typeWithTrashed->name }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <br>
        </table>

        {{-- <div class="modal fade" id="lihat-{{ $hotel->id }}" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="showProduk">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset(env('PATH_GAMBAR_HOTEL').$hotel->id.'.jpg') }}" style="Width:200px"/>
                    <p>Alamat: {{$hotel->address}}</p>
                    <p>Kota: {{$hotel->city}}</p>
                    <p>Negara: {{$hotel->state}}</p>
                    <p>Kode Pos: {{$hotel->postcode}}</p>
                </div>
            </div>
        </div>
    </div> --}}


    @endsection

    @section('anak2', 'Hotel List')
    @section('anak3', 'Halaman Daftar Hotel')

    @section('javascript')
        <script>
            function showProduk(id) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('hotel.showProduk') }}',
                    data: {
                        '_token': '<?php echo csrf_token(); ?>',
                        'hotel_id': id
                    },
                    success: function(data) {
                        $('#showProduk').html(data);
                    }
                });
            }

            // $('.tombol-produk').click(function(){
            //     var idHotel = $(this).attr('data-id')
            //     $.ajax({
            //     type:'GET',
            //     url:'{{ url('/tampilProduk/') }}/'+idHotel,
            //     success: function(data){
            //        $('.coba').html(data.msg)
            //     }
            //   });
            // })
        </script>
    @endsection


    <!-- </body>

    </html> -->
