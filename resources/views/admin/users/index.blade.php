@extends('admin.layout.template')
@section('content')
    <div class="container-fluid">
        <div class="admin-users-index-main" id="main">
            
            @if ($message = Session::get('success'))
                <div class="alert alert-success">{{ $message }}</div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger">{{ $message }}</div>
            @endif
            
            <div class="card p-3 mb-3">
                <h4>Register User</h4>
                <form action="{{ route('users.store') }}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="name" class="form-label">User name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col pt-1">
                            <h6>User Email</h6>
                            <div class="input-group">
                                <label for="email" class="input-group-text">@</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="password2" class="form-label">Confirm Password</label>
                                <input type="password" name="password2" id="password2" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <h6>Package for Outlet</h6>
                            <select name="outlet_id" id="outlet_id" class="form-select">
                                <option>Pick outlet for your package!</option>
                                @foreach ($outlets as $outlet)
                                    <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col pt-1">
                            <h6>User Outlet</h6>
                            <div class="card">
                                <div class="d-flex py-1 px-3">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="role" id="role" value="cashier" class="form-check-input" required>
                                        <label for="role" class="form-check-label">Cashier</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="role" id="role" value="admin" class="form-check-input" required>
                                        <label for="role" class="form-check-label">Admin</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="role" id="role" value="owner" class="form-check-input" required>
                                        <label for="role" class="form-check-label">Owner</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Add</button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Outlet</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->outlet->name }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary me-2">Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection