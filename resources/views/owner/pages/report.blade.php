@extends('owner.layout.template')
@section('content')
    <div class="container-fluid">
        <div class="owner-pages-report-main" id="main">
            <div class="card p-3">
                <div class="row">
                    <div class="col">
                        <h5>OLAISA LAUNDRY REPORT</h5>
                        <p class="m-0">TRANSACTIONS REPORT</p>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary float-end" onclick="window.print()">Print Report</button>
                    </div>
                </div>
                <hr>
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
                                <th>Status</th>
                                <th>Payment Status</th>
                                <th>Payment Date</th>
                                <th>Total</th>
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
                                    <td>{{ $transaction->status }}</td>
                                    <td>{{ $transaction->payment_status }}</td>
                                    <td>{{ Carbon\Carbon::parse($transaction->payment_date)->format('d-m-Y') }}</td>
                                    <td>Rp {{ number_format($transaction->total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between">
                    <h6><strong>Total</strong></h6>
                    <h6><strong>Rp {{ number_format($total, 2) }}</strong></h6>
                </div>
            </div>
        </div>
    </div>
@endsection