<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>

    <div class="container">
        <h2>Product Detail</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga Produk</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>Hotel ID</th>
                    <th>Hotel Name</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->price }}</td>
                    <td>{{ $data->created_at }}</td>
                    <td>{{ $data->updated_at }}</td>
                    <td>{{ $data->hotel_id }}</td>
                    <td>{{ $data->hotel->name }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $data->name }}</h5>
                        <ul class="list-group list-group-flush">
                            <p>Available Room: {{ $data->available_room }}</p>
                            <p>Price: {{ $data->price }}</p>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>