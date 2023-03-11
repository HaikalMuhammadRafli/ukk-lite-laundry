<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\Member;
use App\Models\Package;
use App\Models\TransactionDetail;
use Carbon\Carbon;

class CashierTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter1 = $request->status;
        $filter2 = $request->payment_status;
        $key = $request->query('key');

        if ($filter1) {
            $transactions = Transaction::orderBy('created_at', 'desc')
                                        ->where('status', $filter1)
                                        ->paginate(10);

            if ($key) {
                $searched = Transaction::orderBy('created_at', 'desc')
                                        ->where('status', $filter1)
                                        ->Where('invoice_code', 'like', '%' . $key . '%')
                                        ->orWhereHas('outlet', function ($q) use ($key) {
                                            $q->where('name', 'like', '%' . $key . '%');
                                        })->where('status', $filter1)
                                        ->orWhereHas('member', function ($q) use ($key) {
                                            $q->where('name', 'like', '%' . $key . '%');
                                        })->where('status', $filter1)
                                        ->paginate(10);
            }

        } elseif ($filter2) {
            $transactions = Transaction::orderBy('created_at', 'desc')
                                        ->where('payment_status', $filter2)
                                        ->paginate(10);

            if ($key) {
                $searched = Transaction::orderBy('created_at', 'desc')
                                        ->where('payment_status', $filter2)
                                        ->Where('invoice_code', 'like', '%' . $key . '%')
                                        ->orWhereHas('outlet', function ($q) use ($key) {
                                            $q->where('name', 'like', '%' . $key . '%');
                                        })->where('payment_status', $filter2)
                                        ->orWhereHas('member', function ($q) use ($key) {
                                            $q->where('name', 'like', '%' . $key . '%');
                                        })->where('payment_status', $filter2)
                                        ->paginate(10);
            }

        } elseif ($filter1 && $filter2) {
            $transactions = Transaction::orderBy('created_at', 'desc')
                                        ->where('status', $filter1)
                                        ->where('payment_status', $filter2)
                                        ->paginate(10);

            if ($key) {
                $searched = Transaction::orderBy('created_at', 'desc')
                                        ->where('status', $filter1)
                                        ->where('payment_status', $filter2)
                                        ->Where('invoice_code', 'like', '%' . $key . '%')
                                        ->orWhereHas('outlet', function ($q) use ($key) {
                                            $q->where('name', 'like', '%' . $key . '%');
                                        })->where('status', $filter1)->where('payment_status', $filter2)
                                        ->orWhereHas('member', function ($q) use ($key) {
                                            $q->where('name', 'like', '%' . $key . '%');
                                        })->where('status', $filter1)->where('payment_status', $filter2)
                                        ->paginate(10);
            }

        } else {
            $transactions = Transaction::orderBy('created_at', 'desc')->paginate(10);

            if ($key) {
                $searched = Transaction::orderBy('created_at', 'desc')
                                    ->Where('invoice_code', 'like', '%' . $key . '%')
                                    ->orWhereHas('outlet', function ($q) use ($key) {
                                        $q->where('name', 'like', '%' . $key . '%');
                                    })
                                    ->orWhereHas('member', function ($q) use ($key) {
                                        $q->where('name', 'like', '%' . $key . '%');
                                    })
                                    ->paginate(10);
            }
        }

        $outlets = Outlet::orderBy('created_at', 'desc')->get();
        $members = Member::orderBy('created_at', 'desc')->get();
        $packages = Package::orderBy('created_at', 'desc')->get();

        if ($key) {
            $data = array(
                'title' => 'Transactions',       
                'transactions' => $transactions,
                'transactions' => $searched,
                'outlets' => $outlets,
                'members' => $members,
                'packages' => $packages,
            );
        } else {
            $data = array(
                'title' => 'Transactions',       
                'transactions' => $transactions,
                'outlets' => $outlets,
                'members' => $members,
                'packages' => $packages,
            );
        }

        return view('cashier.transactions.index', $data)->with('no', ($request->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'outlet_id' => 'required',
            'member_id' => 'required',
            'date'      => 'required',
            'deadline'  => 'required',
            'additional_cost' => 'required',
            'discount'  => 'required',
            'tax'       => 'required',
            'package_id' => 'required',
            'qty'       => 'required',
            'description' => 'required',
        ]);

        $user = $request->user();
        $package = Package::findOrFail($request->package_id);

        $transcount = Transaction::count();
        //$total = ($package->price * $request->qty + $request->additional_cost - ($package->price * $request->qty + $request->additional_cost) * $request->discount / 100) + $request->tax;
        $total = (($package->price - ($package->price * $request->discount / 100)) * $request->qty + $request->additional_cost) + $request->tax;

        $input2 = $request->all();
        if ($transcount) {
            $input2['invoice_code'] = 'TR - ' . $transcount + 1;
        } else {
            $input2['invoice_code'] = 'TR - 1';
        }
        $input2['total'] = $total;
        $input2['user_id'] = $user->id;

        $transaction = Transaction::create($input2);

        if ($transaction) {
            $input1 = $request->all();
            $input1['transaction_id'] = $transaction->id; 
            $transactiondetail = TransactionDetail::create($input1);

            if ($transactiondetail) {
                return back()->with('success', 'Transaction has been added!');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $data = array(
            'title' => 'Transaction Detail',
            'transaction' => $transaction, 
        );
        return view('cashier.transactions.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $outlets = Outlet::orderBy('created_at', 'desc')->get();
        $members = Member::orderBy('created_at', 'desc')->get();
        $packages = Package::orderBy('created_at', 'desc')->get();

        $data = array(
            'title' => 'Edit Transaction',
            'transaction' => $transaction,
            'outlets' => $outlets,
            'members' => $members,
            'packages' => $packages,
        );

        return view('cashier.transactions.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $this->validate($request, [
            'outlet_id' => 'required',
            'member_id' => 'required',
            'date'      => 'required',
            'deadline'  => 'required',
            'additional_cost' => 'required',
            'discount'  => 'required',
            'tax'       => 'required',
            'package_id' => 'required',
            'qty'       => 'required',
            'description' => 'required',

            'status' => 'required',
            'payment_status' => 'required',
            'payment_date' => 'required',
        ]);

        $package = Package::findOrFail($request->package_id);
        //$total = ($package->price * $request->qty + $request->additional_cost - ($package->price * $request->qty + $request->additional_cost) * $request->discount / 100) + $request->tax;
        $total = (($package->price - ($package->price * $request->discount / 100)) * $request->qty + $request->additional_cost) + $request->tax;

        $input2 = $request->all();
        $input2['total'] = $total;

        if ($transaction->update($input2)) {
            $input1 = $request->all();
            $transactiondetail = $transaction->detail;

            if ($transactiondetail->update($input1)) {
                return redirect()->route('transactions.index')->with('success', 'Transaction has been edited!');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        if ($transaction->payment_status == 'Pending') {
            if ($transaction->delete()) {
                return back()->with('success', 'Transaction has been deleted!');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Cannot be deleted!');
        }
    }

    public function pay($id) {
        $date = Carbon::now();

        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'payment_status' => 'Completed',
            'payment_date' => $date,
        ]);

        if ($transaction) {
            return back()->with('success', 'Payment is Completed!');
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function status($id) {
        $transaction = Transaction::findOrFail($id);
        switch ($transaction->status) {
            case 'New':
                $status = 'Processing';
                break;
            
            case 'Processing':
                $status = 'Completed';
                break;

            case 'Completed':
                $status = 'Taken';
                break;
        }

        if ($transaction->update(['status' => $status])) {
            return back()->with('success', 'Status has been progressed!');
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }
}
