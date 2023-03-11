@extends('cashier.layout.template')
@section('content')
    <div class="container-fluid">
        <div class="cashier-pages-dashboard-main" id="main">
        <div class="card p-3 mb-5">
                <div class="row">
                    <div class="col">
                        <div class="card p-3">
                            <h5>Members</h5>
                            <hr>
                            <h6>{{ $membercount }}</h6>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card p-3">
                            <h5>Transactions</h5>
                            <hr>
                            <h6>{{ $transactioncount }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <h5>New Transaction</h5>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ ++$no }}</td>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection