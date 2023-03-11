<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $key = $request->query('key');
        $outlets = Outlet::orderBy('created_at', 'desc')->paginate(20);
        $searched = Outlet::orderBy('created_at', 'desc')
                            ->where('name', 'like', '%' . $key . '%')
                            ->paginate(20);
        $data = array(
            'title' => 'Outlets',
            'outlets' => $outlets,
            'outlets' => $searched
        );

        return view('admin.outlets.index', $data)->with('no', ($request->input('page', 1) - 1 ) * 20);
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
            'phone' => 'required',
        ]);

        $input = $request->all();
        $input['phone'] = '+62'. $request->phone; 
        $outlet = Outlet::create($input);

        if ($outlet) {
            return back()->with('success', 'Outlet successfully Added!');
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Outlet $outlet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Outlet $outlet)
    {
        $data = array(
            'title' => 'Edit Outlet',
            'outlet' => $outlet
        );

        return view('admin.outlets.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Outlet $outlet)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $input = $request->all();

        if ($outlet->update($input)) {
            return redirect()->route('outlets.index')->with('success', 'Outlet has been edited!');
        } else {
            return redirect()->route('outlets.index')->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Outlet $outlet)
    {
        if ($outlet->delete()) {
            return back()->with('success', 'Outlet has been deleted!');
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }
}
