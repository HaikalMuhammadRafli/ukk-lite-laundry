@extends('admin.layout.template')
@section('content')
    <div class="container-fluid">
        <div class="admin-users-edit-main" id="main">

            @if ($message = Session::get('success'))
                <div class="alert alert-success">{{ $message }}</div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger">{{ $message }}</div>
            @endif

            <div class="card p-3">
                <h4>Edit User</h4>
                <form action="{{ route('users.update', $user->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="name" class="form-label">User name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                            </div>
                        </div>
                        <div class="col pt-1">
                            <h6>User Email</h6>
                            <div class="input-group">
                                <label for="email" class="input-group-text">@</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" name="password" id="password" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="password2" class="form-label">Confirm Password</label>
                                <input type="text" name="password2" id="password2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <h6>Package for Outlet</h6>
                            <select name="outlet_id" id="outlet_id" class="form-select">
                                <option>Pick outlet for your package!</option>
                                @foreach ($outlets as $outlet)
                                    <option value="{{ $outlet->id }}" {{ $outlet->id == $user->outlet_id ? 'selected' : '' }}>{{ $outlet->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col pt-1">
                            <h6>User Outlet</h6>
                            <div class="card">
                                <div class="d-flex py-1 px-3">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="role" id="role" value="cashier" class="form-check-input" required {{ $user->role == 'cashier' ? 'checked' : '' }}>
                                        <label for="role" class="form-check-label">Cashier</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="role" id="role" value="admin" class="form-check-input" required {{ $user->role == 'admin' ? 'checked' : '' }}>
                                        <label for="role" class="form-check-label">Admin</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="role" id="role" value="owner" class="form-check-input" required {{ $user->role == 'owner' ? 'checked' : '' }}>
                                        <label for="role" class="form-check-label">Owner</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection