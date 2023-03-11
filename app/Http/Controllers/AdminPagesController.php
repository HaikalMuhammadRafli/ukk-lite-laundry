<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Member;
use App\Models\Outlet;
use App\Models\User;
use App\Models\Package;

class AdminPagesController extends Controller
{
    public function dashboard(Request $request) {
        $outletcount = Outlet::count();
        $usercount = User::count();
        $membercount = Member::count();
        $packagecount = Package::count();
        $transactioncount = Transaction::count();
        $transactions = Transaction::orderBy('created_at', 'desc')
                                    ->where('status', 'New')
                                    ->paginate(5);

        $data = array(
            'title' => 'Admin Dashboard',
            'outletcount' => $outletcount,
            'usercount' => $usercount,
            'membercount' => $membercount,
            'packagecount' => $packagecount,
            'transactioncount' => $transactioncount,
            'transactions' => $transactions,
        );

        return view('admin.pages.dashboard', $data)->with('no', ($request->input('page', 1) - 1) * 5);
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

        return view('admin.pages.report', $data)->with('no');
    }
}
