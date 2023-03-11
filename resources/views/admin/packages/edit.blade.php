@extends('admin.layout.template')
@section('content')
    <div class="container-fluid">
        <div class="admin-packages-edit-main" id="main">
            <div class="card p-3">
                <h4>Add New Packages</h4>
                <form action="{{ route('packages.update', $package->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-3">
                        <div class="col">
                            <h6>Package for Outlet</h6>
                            <select name="outlet_id" id="outlet_id" class="form-select">
                                <option>Pick outlet for your package!</option>
                                @foreach ($outlets as $outlet)
                                    <option value="{{ $outlet->id }}" {{ $outlet->id == $package->outlet_id ? 'selected' : '' }}>{{ $outlet->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <h6>Package Category</h6>
                            <div class="card py-2 px-3">
                                <div class="d-flex">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="category" id="category" value="Weight" class="form-check-input" required {{ $package->category == 'Weight' ? 'checked' : '' }}>
                                        <label for="category" class="form-check-label">Weight</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="category" id="category" value="Blanket" class="form-check-input" required {{ $package->category == 'Blanket' ? 'checked' : '' }}>
                                        <label for="category" class="form-check-label">Blanket</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="category" id="category" value="Bed_cover" class="form-check-input" required {{ $package->category == 'Bed_cover' ? 'checked' : '' }}>
                                        <label for="category" class="form-check-label">Bed Cover</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="category" id="category" value="Clothes" class="form-check-input" required {{ $package->category == 'Clothes' ? 'checked' : '' }}>
                                        <label for="category" class="form-check-label">Clothes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="category" id="category" value="Other" class="form-check-input" required {{ $package->category == 'Other' ? 'checked' : '' }}>
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
                                <input type="text" class="form-control" name="name" id="name" value="{{ $package->name }}" required>
                            </div>
                        </div>
                        <div class="col pt-1">
                            <h6>Package Price</h6>
                            <div class="input-group">
                                <label for="price" class="input-group-text">Rp</label>
                                <input type="number" name="price" id="price" class="form-control" value="{{ $package->price }}" required>
                                <label for="price" class="input-group-text">.00</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection