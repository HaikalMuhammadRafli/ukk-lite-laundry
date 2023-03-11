@extends('cashier.layout.template')
@section('content')
    <div class="container-fluid">
        <div class="cashier-members-edit-main" id="main">
            <div class="card p-3 mb-3">
                <h4>Register Member</h4>
                <form action="{{ route('members.update', $member->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name" class="form-label">Member Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $member->name }}" required>
                            </div>
                        </div>
                        <div class="col">
                            <h6>Member Gender</h6>
                            <div class="card py-2 px-3">
                                <div class="d-flex">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="gender" id="genderL" value="L" class="form-check-input" required {{ $member->gender == 'L' ? 'checked' : '' }}>
                                        <label for="genderL" class="form-check-label">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="gender" id="genderP" value="P" class="form-check-input" required {{ $member->gender == 'P' ? 'checked' : '' }}>
                                        <label for="genderP" class="form-check-label">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <h6 class="pt-1">Member Phone Number</h6>
                            <div class="input-group">
                                <label for="phone" class="input-group-text">+62</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ $member->phone }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Member Address</label>
                        <textarea class="form-control" name="address" id="address" cols="2" rows="2" required>{{ $member->address }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection