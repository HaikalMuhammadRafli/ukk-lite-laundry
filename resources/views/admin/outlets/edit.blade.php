@extends('admin.layout.template')
@section('content')
    <div class="container-fluid">
        <div class="admin-outlets-edit-main" id="main">
            <div class="card p-3">
                <form action="{{ route('outlets.update', $outlet->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name" class="form-label">Outlet Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $outlet->name }}" required>
                            </div>
                        </div>
                        <div class="col">
                            <h6 class="pt-1">Outlet Phone Number</h6>
                            <div class="input-group">
                                <label for="phone" class="input-group-text">+62</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ $outlet->phone }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Outlet Address</label>
                        <textarea class="form-control" name="address" id="address" cols="2" rows="2" required>{{ $outlet->address }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection