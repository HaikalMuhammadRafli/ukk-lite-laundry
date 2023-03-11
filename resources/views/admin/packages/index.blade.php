@extends('admin.layout.template')
@section('content')
    <div class="container-fluid">
        <div class="admin-packages-index-main" id="main">

            @if ($message = Session::get('success'))
                <div class="alert alert-success">{{ $message }}</div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger">{{ $message }}</div>
            @endif

            <div class="card p-3 mb-3">
                <h4>Add New Packages</h4>
                <form action="{{ route('packages.store') }}" method="post">
                    @csrf
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
                        <div class="col">
                            <h6>Package Category</h6>
                            <div class="card py-2 px-3">
                                <div class="d-flex">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="category" id="category" value="Weight" class="form-check-input" required>
                                        <label for="category" class="form-check-label">Weight</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="category" id="category" value="Blanket" class="form-check-input" required>
                                        <label for="category" class="form-check-label">Blanket</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="category" id="category" value="Bed_cover" class="form-check-input" required>
                                        <label for="category" class="form-check-label">Bed Cover</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="category" id="category" value="Clothes" class="form-check-input" required>
                                        <label for="category" class="form-check-label">Clothes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="category" id="category" value="Other" class="form-check-input" required>
                                        <label for="category" class="form-check-label">Other</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="name" class="form-label">Package Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                        </div>
                        <div class="col pt-1">
                            <h6>Package Price</h6>
                            <div class="input-group">
                                <label for="price" class="input-group-text">Rp</label>
                                <input type="number" name="price" id="price" class="form-control" required>
                                <label for="price" class="input-group-text">.00</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Add</button>
                </form>
            </div>

            <div class="card mb-3 p-3">
                <form action="{{ route('package.search') }}" method="get">
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
                            <th>Outlet</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($packages as $package)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $package->name }}</td>
                                <td>{{ $package->outlet->name }}</td>
                                <td>{{ $package->category }}</td>
                                <td>Rp {{ number_format($package->price, 1) }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('packages.edit', $package->id) }}" class="btn btn-primary me-2">Edit</a>
                                        <form action="{{ route('packages.destroy', $package->id) }}" method="post">
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
            {{ $packages->links() }}
        </div>
    </div>
@endsection