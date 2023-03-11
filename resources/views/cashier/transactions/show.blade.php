@extends('cashier.layout.template')
@section('content')
    <div class="container-fluid">
        <div class="cashier-transactions-show-main" id="main">
            
            @if ($message = Session::get('success'))
                <div class="alert alert-success">{{ $message }}</div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger">{{ $message }}</div>
            @endif

            <div class="card p-3">
                <div class="row">
                    <div class="col">
                        <h4>{{ $transaction->invoice_code }}</h4>
                        <p class="m-0">Olaisa Laundry Service</p>
                    </div>
                    <div class="col">
                        <div class="float-end">
                            @if ($transaction->payment_status != 'Pending')
                                <div class="d-flex">
                                    <h4 class="btn btn-primary me-2">Status {{ $transaction->status }}</h4>
                                    <h4 class="btn btn-success">Payment {{ $transaction->payment_status }}</h4>
                                </div>
                                <p class="m-0"><strong>Payment Date :</strong> {{ Carbon\Carbon::parse($transaction->payment_date)->format('d-m-Y H:i:s') }}</p>
                            @else
                                <div class="d-flex">
                                    <h4 class="btn btn-primary me-2">Status {{ $transaction->status }}</h4>
                                    <h4 class="btn btn-danger">Payment {{ $transaction->payment_status }}</h4>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col">
                        <div class="card p-3">
                            <h5>Transaction Details</h5>
                            <p class="m-0"><strong>Outlet :</strong> {{ $transaction->outlet->name }}</p>
                            <p class="m-0"><strong>Date :</strong> {{ Carbon\Carbon::parse($transaction->date)->format('d-m-Y') }}</p>
                            <p class="m-0"><strong>Deadline :</strong> {{ Carbon\Carbon::parse($transaction->deadline)->format('d-m-Y') }}</p>
                            <p class="m-0"><strong>Package Price :</strong> Rp {{ number_format($transaction->detail->package->price, 2) }}</p>
                            <p class="m-0"><strong>Quantity :</strong> {{ $transaction->detail->qty }}</p>
                            <p class="m-0"><strong>Discount :</strong> {{ $transaction->discount }}% off</p>
                            <p class="m-0"><strong>Tax :</strong> Rp {{ number_format($transaction->tax, 2) }}</p>
                            <p class="m-0"><strong>Total :</strong> Rp {{ number_format($transaction->total, 2) }}</p>
                            <p class="m-0"><strong>Description :</strong></p>
                            <pre>{{ $transaction->detail->description }}</pre>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card p-3 mb-3">
                        <h5>Member Details</h5>
                            <p class="m-0"><strong>Name :</strong> {{ $transaction->member->name }}</p>
                            <p class="m-0"><strong>Gender :</strong> {{ $transaction->member->gender }}</p>
                            <p class="m-0"><strong>Address :</strong> {{ $transaction->member->address }}</p>
                            <p class="m-0"><strong>Phone Number :</strong> {{ $transaction->member->phone }}</p>
                        </div>
                        <div class="card p-3">
                            <h5>Package Details</h5>
                            <p class="m-0"><strong>Name :</strong> {{ $transaction->detail->package->name }}</p>
                            <p class="m-0"><strong>Outlet :</strong> {{ $transaction->detail->package->outlet->name }}</p>
                            <p class="m-0"><strong>Category :</strong> {{ $transaction->detail->package->category }}</p>
                            <p class="m-0"><strong>Price :</strong> Rp {{ number_format($transaction->detail->package->price, 2) }}</p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-primary mb-3">Edit</a>

                @if ($transaction->payment_status != 'Pending')
                    @if ($transaction->status == 'New')
                        <a href="{{ route('cashier.transaction.status', $transaction->id) }}" class="btn btn-secondary mb-3">Process</a>
                    @elseif ($transaction->status == 'Processing')
                        <a href="{{ route('cashier.transaction.status', $transaction->id) }}" class="btn btn-secondary mb-3">Complete</a>
                    @elseif ($transaction->status == 'Completed')
                        <a href="{{ route('cashier.transaction.status', $transaction->id) }}" class="btn btn-secondary mb-3">Taken</a>
                    @endif
                    <button type="button" class="btn btn-primary" onclick="window.print()">Print</button>
                @else
                    <a href="{{ route('cashier.transaction.pay', $transaction->id) }}" class="btn btn-success">Pay Up Front</a>
                @endif
            </div>
        </div>
    </div>
@endsection