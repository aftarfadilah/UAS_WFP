<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel APA Hotel Asakura Kuramae</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(18rem, 1fr));
            gap: 20px;
        }
        .card {
            max-width: 18rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-img-top {
            width: 100%;
            height: auto;
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .card-text {
            margin-top: 10px;
        }
        .btn {
            margin-top: 10px;
        }
        h1 {
            text-align: center;
        }
    </style>

</head>

<body>
    @if(isset($kategori))
        @if($kategori=='single')
            <h2>Menu Hotel {{$kategori}}</h2>
            <div class="card" style="width: 18rem;">
            <img src="https://i.pinimg.com/564x/52/76/7f/52767fe4b5814593d2ccb937bb81c58b.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Single</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <!-- <a href="{{ url('/kategori/single') }}" class="btn btn-primary">Go somewhere</a> -->
            </div>
        </div>
        @elseif($kategori=='single-semi-double')
        <h2>Menu Hotel {{$kategori}}</h2>
            <div class="card" style="width: 18rem;">
            <img src="https://i.pinimg.com/564x/98/fc/f0/98fcf060250d64ebf0da34c2fb3bdc20.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Single Semi-Double</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <!-- <a href="{{ url('/kategori/single-semi-double') }}" class="btn btn-primary">Go somewhere</a> -->
            </div>
        @elseif($kategori=='standard-double')
        <h2>Menu Hotel {{$kategori}}</h2>
            <div class="card" style="width: 18rem;">
            <img src="https://i.pinimg.com/236x/f0/28/ad/f028adaef3ad58580cc2068c1a1a8259.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Single Semi-Double</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <!-- <a href="{{ url('/kategori/standard-double') }}" class="btn btn-primary">Go somewhere</a> -->
            </div>
        @else
        <h1>Pilih jenis hotel{{$kategori}}</h1>
            <div class="grid-container">
        <div class="card">
            <img src="https://i.pinimg.com/564x/d7/39/09/d73909890bc32a2dc5219e443bceb598.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Single</h5>
                <p class="card-text">This is 3rd Star Hotel</p>
                <a class="btn btn-primary" href="{{ url('/kategori/single') }}" role="button">More</a>
            </div>
        </div>

        <div class="card">
            <img src="https://i.pinimg.com/564x/2c/ca/fc/2ccafc4ad8001db3f3e539959102ba69.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Single Semi-Double</h5>
                <p class="card-text">This is 4th Star Hotel.</p>
                <a class="btn btn-primary" href="{{ url('/kategori/single-semi-double') }}" role="button">More</a>
            </div>
        </div>

        <div class="card">
            <img src="https://i.pinimg.com/564x/ec/19/8b/ec198ba2a9cd6ed6ee33ed35285a6ecd.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Standard Double</h5>
                <p class="card-text">This is 5th Star Hotel.</p>
                <a class="btn btn-primary" href="{{ url('/kategori/standard-double') }}" role="button">More</a>
            </div>
        </div>
    </div>
        @endif
    @else
    <h1>Selamat Datang di Hotel APA Hotel Asakakura Kuramae</h1>
    <a href="{{url('/kategori')}}">Kategori</a><br>
    <a href="{{url('/promo')}}">Promo</a>
    @endif

</body>

</html>