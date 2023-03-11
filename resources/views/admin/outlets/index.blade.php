@extends('admin.layout.template')
@section('content')
    <div class="container-fluid">
        <div class="admin-outlets-index-main" id="main">

            @if ($message = Session::get('success'))
                <div class="alert alert-success">{{ $message }}</div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger">{{ $message }}</div>
            @endif

            <div class="card p-3 mb-3">
                <form action="{{ route('outlets.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name" class="form-label">Outlet Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <h6 class="pt-1">Outlet Phone Number</h6>
                            <div class="input-group">
                                <label for="phone" class="input-group-text">+62</label>
                                <input type="text" name="phone" id="phone" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Outlet Address</label>
                        <textarea class="form-control" name="address" id="address" cols="2" rows="2" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>

            <div class="card mb-3 p-3">
                <form action="{{ route('outlet.search') }}" method="get">
                    <div class="d-flex">
                        <input type="text" name="key" id="key" class="form-control me-2" placeholder="Search">
                        <button type="submit" class="btn btn-outline-success">Search</button>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($outlets as $outlet)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $outlet->name }}</td>
                                <td>{{ $outlet->address }}</td>
                                <td>{{ $outlet->phone }}</td>
                                <td>
                                <div class="d-flex">
                                        <a href="{{ route('outlets.edit', $outlet->id) }}" class="btn btn-primary me-2">Edit</a>
                                        <form action="{{ route('outlets.destroy', $outlet->id) }}" method="post">
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
            {{ $outlets->links() }}
        </div>
    </div>
@endsection