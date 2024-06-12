<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>

    <div class="container">
        <h2>Reporting</h2>
        <p>Average Hotel Price</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Name</th>
                    <th>avg_price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr>
                    <td>{{ $d->namet }}</td>
                    <td>{{ $d->name }}</td>
                    <td>{{ $d->avg_price }}</td>
                </tr>
                @endforeach
            </tbody>
            <br>
        </table>
    </div>