<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Outlet;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $key = $request->query('key');
        $outlets = Outlet::orderBy('created_at', 'desc')->get();
        $packages = Package::orderBy('created_at', 'desc')->paginate(20);
        $searched = Package::orderBy('created_at', 'desc')
                            ->where('name', 'like', '%' . $key . '%')
                            ->paginate(20);

        $data = array(
            'title' => 'Packages',
            'outlets' => $outlets,
            'packages' => $packages,
            'packages' => $searched,
        );

        return view('admin.packages.index', $data)->with('no', ($request->input('page', 1) - 1 ) * 20);
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
            'category' => 'required',
            'name' => 'required',
            'price' => 'required'
        ]);

        $input = $request->all();

        $package = Package::create($input);

        if ($package) {
            return back()->with('success', 'Package successfully registered!');
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        $outlets = Outlet::orderBy('created_at', 'desc')->get();

        $data = array(
            'title' => 'Edit Package',
            'package' => $package,
            'outlets' => $outlets
        );

        return view('admin.packages.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        $this->validate($request, [
            'outlet_id' => 'required',
            'category' => 'required',
            'name' => 'required',
            'price' => 'required'
        ]);

        $input = $request->all();

        if ($package->update($input)) {
            return redirect()->route('packages.index')->with('success', 'Package has been edited!');
        } else {
            return redirect()->route('packages.index')->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        if ($package->delete()) {
            return back()->with('success', 'Package has been deleted!');
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }
}
