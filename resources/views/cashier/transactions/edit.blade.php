@extends('cashier.layout.template')
@section('content')
    <div class="container-fluid">
        <div class="cashier-transactions-edit-main" id="main">

            @if ($message = Session::get('success'))
                <div class="alert alert-success">{{ $message }}</div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger">{{ $message }}</div>
            @endif

            <div class="card p-3 mb-3">
                <h4>Transaction</h4>
                <form action="{{ route('transactions.update', $transaction) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-3">
                        <div class="col">
                            <h6>Pick the Outlet</h6>
                            <select name="outlet_id" id="outlet_id" class="form-select">
                                <option>Pick outlet for your transaction!</option>
                                @foreach ($outlets as $outlet)
                                    <option value="{{ $outlet->id }}" {{ $outlet->id == $transaction->outlet_id ? 'selected' : ''}}>{{ $outlet->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <h6>Pick the member</h6>
                            <select name="member_id" id="member_id" class="form-select">
                                <option>Pick member for your transaction!</option>
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}" {{ $member->id == $transaction->outlet_id ? 'selected' : ''}}>{{ $member->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" name="date" id="date" class="form-control" value="{{ Carbon\Carbon::parse($transaction->date)->format('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="deadline" class="form-label">Deadline</label>
                                <input type="date" name="deadline" id="deadline" class="form-control" value="{{ Carbon\Carbon::parse($transaction->deadline)->format('Y-m-d') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <h6>Additional cost</h6>
                            <div class="input-group">
                                <label for="additional_cost" class="input-group-text">Rp</label>
                                <input type="number" name="additional_cost" id="additional_cost" class="form-control" value="{{ $transaction->additional_cost }}" required>
                                <label for="additional_cost" class="input-group-text">.0</label>
                            </div>
                        </div>
                        <div class="col">
                            <h6>Discount</h6>
                            <div class="input-group">
                                <input type="number" name="discount" id="discount" class="form-control" value="{{ $transaction->discount }}" required>
                                <label for="discount" class="input-group-text">%</label>
                            </div>
                        </div>
                        <div class="col">
                            <h6>Tax</h6>
                            <div class="input-group">
                                <label for="tax" class="input-group-text">Rp</label>
                                <input type="number" name="tax" id="tax" class="form-control" value="{{ $transaction->tax }}" required>
                                <label for="tax" class="input-group-text">.0</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h6>Change Status!</h6>
                            <select name="status" id="status" class="form-select">
                                <option>Pick your transaction status!</option>
                                <option value="New" {{ $transaction->status == 'New' ? 'selected' : ''}}>New</option>
                                <option value="Processing" {{ $transaction->status == 'Processing' ? 'selected' : ''}}>Processing</option>
                                <option value="Completed" {{ $transaction->status == 'Completed' ? 'selected' : ''}}>Completed</option>
                                <option value="Taken" {{ $transaction->status == 'Taken' ? 'selected' : ''}}>Taken</option>
                            </select>
                        </div>
                        <div class="col">
                            <h6>Change Payment Status!</h6>
                            <select name="payment_status" id="payment_status" class="form-select">
                                <option>Pick your transaction payment status!</option>
                                <option value="Pending" {{ $transaction->payment_status == 'Pending' ? 'selected' : ''}}>Pending</option>
                                <option value="Completed" {{ $transaction->payment_status == 'Completed' ? 'selected' : ''}}>Completed</option>
                            </select>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="payment_date" class="form-label">Payment Date</label>
                                <input type="date" name="payment_date" id="payment_date" class="form-control" value="{{ Carbon\Carbon::parse($transaction->payment_date)->format('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5>Detail</h5>
                    <div class="row mb-3">
                        <div class="col">
                            <h6>Pick the package</h6>
                            <select name="package_id" id="package_id" class="form-select">
                                <option>Pick package for your transaction!</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}" {{ $package->id == $transaction->detail->package_id ? 'selected' : ''}}>{{ $package->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <h6>Quantity</h6>
                            <div class="input-group">
                                <label for="qty" class="input-group-text">qty</label>
                                <input type="number" name="qty" id="qty" class="form-control" value="{{ $transaction->detail->qty }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" cols="2" rows="2" class="form-control">{{ $transaction->detail->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection