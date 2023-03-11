<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Member;

class CashierPagesController extends Controller
{
    public function dashboard(Request $request) {
        $membercount = Member::count();
        $transactioncount = Transaction::count();
        $transactions = Transaction::orderBy('created_at', 'desc')
                                    ->where('status', 'New')
                                    ->paginate(5);

        $data = array(
            'title' => 'Cashier Dashboard',
            'membercount' => $membercount,
            'transactioncount' => $transactioncount,
            'transactions' => $transactions,
        );

        return view('cashier.pages.dashboard', $data)->with('no', ($request->input('page', 1) - 1) * 5);;
    }

    public function report() {
        $transactions = Transaction::orderBy('created_at', 'desc')
                                    ->where('status', 'Taken')
                                    ->where('payment_status', 'Completed')
                                    ->get();
        $total = 0;

        foreach ($transactions as $transaction) {
            $total = $total + $transaction->total;
        }
        $data = array(
            'title' => 'Transaction Report',
            'transactions' => $transactions,
            'total' => $total,
        );

        return view('cashier.pages.report', $data)->with('no');
    }
}
