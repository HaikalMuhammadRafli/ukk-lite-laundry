<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class OwnerPagesController extends Controller
{
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

        return view('owner.pages.report', $data)->with('no');
    }
}
