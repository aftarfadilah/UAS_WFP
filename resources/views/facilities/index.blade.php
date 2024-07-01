<!-- resources/views/facilities/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facilities</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Facilities</h1>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($facilities as $facility)
                    <tr>
                        <td>{{ $facility->id }}</td>
                        <td>{{ $facility->name }}</td>
                        <td>{{ $facility->description }}</td>
                        <td>
                            <a href="{{ route('facilities.edit', $facility->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('facilities.destroy', $facility->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this facility?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <a href="{{ route('facilities.create') }}" class="btn btn-primary">Add Facility</a>
    </div>
</body>
</html>
