<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class CashierMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $key = $request->query('key');
        $members = Member::orderBy('created_at', 'desc')->paginate(20);
        $searched = Member::orderBy('created_at', 'desc')
                            ->where('name', 'like', '%' . $key . '%')
                            ->paginate(20);
        $data = array(
            'title' => 'Members',
            'members' => $members,
            'members' => $searched,
        );

        return view('cashier.members.index', $data)->with('no', ($request->input('page', 1) - 1 ) * 20);
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
            'name' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'phone' => 'numeric|required',
        ]);

        $input = $request->all();
        $input['phone'] = '+62'. $request->phone; 
        $member = Member::create($input);

        if ($member) {
            return back()->with('success', 'Member successfully registered!');
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        $data = array(
            'title' => 'Edit Membaer',
            'member' => $member
        );

        return view('cashier.members.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'phone' => 'required',
        ]);

        $input = $request->all();

        if ($member->update($input)) {
            return redirect()->route('cashier.index')->with('success', 'Member has been edited!');
        } else {
            return redirect()->route('cashier.index')->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        if ($member->delete()) {
            return back()->with('success', 'Member has been deleted!');
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }
}
