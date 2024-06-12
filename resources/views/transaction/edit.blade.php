@extends('layout.conquer2')

@section('anak')
    <form method="GET" action="{{ route('transaction.store') }}">
        @csrf
        @method('PUT')
        <h2>Add new Transaction</h2>

        <div class="form-group">
            <label for="user">User</label>
            <select class="form-control" name="user" required>
                @if ($data)
                <option value="{{ $data->user_id }}" selected>{{ $data->user->name }}</option>
            @else
                <option selected disabled>Select a user</option>
            @endif

            @foreach ($users as $u)
                <option value="{{ $u->id }}">{{ $u->name }}</option>
            @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="customer">Customer</label>
            <select class="form-control" name="customer" required>
            @if ($data)
                <option value="{{ $data->customer_id }}" selected>{{ $data->customer->name }}</option>
            @else
                <option selected disabled>Select a customer</option>
            @endif
            @foreach ($customers as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
            </select>
        </div>

        <a class="btn btn-info" href="{{ route('transaction.index') }}">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection