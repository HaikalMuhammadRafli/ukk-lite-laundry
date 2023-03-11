@extends('cashier.layout.template')
@section('content')
    <div class="container-fluid">
        <div class="cashier-members-index-main" id="main">
            
            @if ($message = Session::get('success'))
                <div class="alert alert-success">{{ $message }}</div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger">{{ $message }}</div>
            @endif

            <div class="card p-3 mb-3">
                <h4>Register Member</h4>
                <form action="{{ route('members.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name" class="form-label">Member Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                        </div>
                        <div class="col">
                            <h6>Member Gender</h6>
                            <div class="card py-2 px-3">
                                <div class="d-flex">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="gender" id="genderL" value="L" class="form-check-input" required>
                                        <label for="genderL" class="form-check-label">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="gender" id="genderP" value="P" class="form-check-input" required>
                                        <label for="genderP" class="form-check-label">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <h6 class="pt-1">Member Phone Number</h6>
                            <div class="input-group">
                                <label for="phone" class="input-group-text">+62</label>
                                <input type="text" name="phone" id="phone" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Member Address</label>
                        <textarea class="form-control" name="address" id="address" cols="2" rows="2" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>

            <div class="card mb-3 p-3">
                <form action="{{ route('cashier.member.search') }}" method="get">
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
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Phone Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->address }}</td>
                                <td>{{ $member->gender }}</td>
                                <td>{{ $member->phone }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('members.edit', $member->id) }}" class="btn btn-primary me-2">Edit</a>
                                        <form action="{{ route('members.destroy', $member->id) }}" method="post">
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
            {{ $members->links() }}
        </div>
    </div>
@endsection