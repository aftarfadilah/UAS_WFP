@extends('layout.conquer2')
@section('anak2', 'Create User')

@section('anak')
<div>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name"><span style="color: red">*</span>Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter User Name" required>
        </div>
        <div class="form-group">
            <label for="name"><span style="color: red">*</span>Email</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email" required>
        </div>
        <div class="form-group">
            <label for="name"><span style="color: red">*</span>Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password" required>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control" name="role" id="role">
                <option value="guest" selected>Guest</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection