@extends('admin.layout.template')
@section('content')
    <div class="container-fluid">
        <div class="admin-transactions-index-main" id="main">
            
            @if ($message = Session::get('success'))
                <div class="alert alert-success">{{ $message }}</div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger">{{ $message }}</div>
            @endif

            <button class="btn btn-primary w-100 mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#transaction-form" aria-expanded="false" aria-controls="transaction-form">Show Transaction Form</button>

            <div class="collapse" id="transaction-form">
                <div class="card p-3 mb-3">
                    <h4>Transaction</h4>
                    <form action="{{ route('transactions.store') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <h6>Pick the Outlet</h6>
                                <select name="outlet_id" id="outlet_id" class="form-select">
                                    <option>Pick outlet for your transaction!</option>
                                    @foreach ($outlets as $outlet)
                                        <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <h6>Pick the member</h6>
                                <select name="member_id" id="member_id" class="form-select">
                                    <option>Pick member for your transaction!</option>
                                    @foreach ($members as $member)
                                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-group">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" name="date" id="date" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="deadline" class="form-label">Deadline</label>
                                    <input type="date" name="deadline" id="deadline" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <h6>Additional cost</h6>
                                <div class="input-group">
                                    <label for="additional_cost" class="input-group-text">Rp</label>
                                    <input type="number" name="additional_cost" id="additional_cost" class="form-control">
                                    <label for="additional_cost" class="input-group-text">.0</label>
                                </div>
                            </div>
                            <div class="col">
                                <h6>Discount</h6>
                                <div class="input-group">
                                    <input type="number" name="discount" id="discount" class="form-control">
                                    <label for="discount" class="input-group-text">%</label>
                                </div>
                            </div>
                            <div class="col">
                                <h6>Tax</h6>
                                <div class="input-group">
                                    <label for="tax" class="input-group-text">Rp</label>
                                    <input type="number" name="tax" id="tax" class="form-control">
                                    <label for="tax" class="input-group-text">.0</label>
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
                                        <option value="{{ $package->id }}">{{ $package->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <h6>Quantity</h6>
                                <div class="input-group">
                                    <label for="qty" class="input-group-text">qty</label>
                                    <input type="number" name="qty" id="qty" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" cols="2" rows="2" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary float-end">Add</button>
                    </form>
                </div>
            </div>

            <div class="card p-3 mb-3">
                <form action="{{ route('transaction.filter') }}" method="get">
                    <div class="row mb-3">
                        <h4>Filter</h4>
                        <hr>
                        <div class="col">
                            <h5>Status</h5>
                            <div class="card p-2">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-check form-switch">
                                            <input type="checkbox" name="status[New]" id="status1" role="switch" value="New" onChange="this.form.submit()" class="form-check-input" {{ request()->filled('status.New') ? 'checked' : ''}}>
                                            <label for="status1" class="form-check-label">New</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check form-switch">
                                            <input type="checkbox" name="status[Processing]" id="status2" role="switch" value="Processing" onChange="this.form.submit()" class="form-check-input" {{ request()->filled('status.Processing') ? 'checked' : ''}}>
                                            <label for="status2" class="form-check-label">Processing</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check form-switch">
                                            <input type="checkbox" name="status[Completed]" id="status3" role="switch" value="Completed" onChange="this.form.submit()" class="form-check-input" {{ request()->filled('status.Completed') ? 'checked' : ''}}>
                                            <label for="status3" class="form-check-label">Completed</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check form-switch">
                                            <input type="checkbox" name="status[Taken]" id="status4" role="switch" value="Taken" onChange="this.form.submit()" class="form-check-input" {{ request()->filled('status.Taken') ? 'checked' : ''}}>
                                            <label for="status4" class="form-check-label">Taken</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <h5>Payment Status</h5>
                            <div class="card p-2">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-check form-switch">
                                            <input type="checkbox" name="payment_status[Pending]" id="payment_status1" role="switch" value="Pending" onChange="this.form.submit()" class="form-check-input" {{ request()->filled('payment_status.Pending') ? 'checked' : ''}}>
                                            <label for="payment_status1" class="form-check-label">Pending</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check form-switch">
                                            <input type="checkbox" name="payment_status[Completed]" id="payment_status2" role="switch" value="Completed" onChange="this.form.submit()" class="form-check-input" {{ request()->filled('payment_status.Completed') ? 'checked' : ''}}>
                                            <label for="payment_status2" class="form-check-label">Completed</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
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
                            <th>Invoice Code</th>
                            <th>Outlet</th>
                            <th>Member</th>
                            <th>Date</th>
                            <th>Deadline</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Payment Status</th>
                            <th>Payment Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $transaction->invoice_code }}</td>
                                <td>{{ $transaction->outlet->name }}</td>
                                <td>{{ $transaction->member->name }}</td>
                                <td>{{ Carbon\Carbon::parse($transaction->date)->format('d-m-Y') }}</td>
                                <td>{{ Carbon\Carbon::parse($transaction->deadline)->format('d-m-Y') }}</td>
                                <td>Rp {{ number_format($transaction->total) }}</td>
                                <td>{{ $transaction->status }}</td>
                                <td>{{ $transaction->payment_status }}</td>
                                <td>{{ $transaction->payment_date == null ? '-' : Carbon\Carbon::parse($transaction->payment_date)->format('d-m-Y') }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-primary me-2">Detail</a>
                                        @if ($transaction->payment_status == 'Pending')
                                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $transactions->links() }}
        </div>
    </div>
@endsection