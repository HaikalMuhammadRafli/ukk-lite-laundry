<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Outlet;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $outlets = Outlet::orderBy('created_at', 'desc')->get();
        $users = User::orderBy('created_at', 'desc')->paginate(20);
        $data = array(
            'title' => 'Members',
            'users' => $users,
            'outlets' => $outlets,
        );

        return view('admin.users.index', $data)->with('no', ($request->input('page', 1) - 1 ) * 20);
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
            'email' => 'required|email',
            'password' => 'required',
            'password2' => 'required',
            'outlet_id' => 'required',
            'role' => 'required',
        ]);

        $password1 = $request->password;
        $password2 = $request->password2;

        if ($password1 == $password2) {
            $input = $request->all();
            $input['password'] = Hash::make($password1);
            $user = User::create($input);

            if ($user) {
                return back()->with('success', 'User has been successfully added!');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Your password does not match!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $outlets = Outlet::orderBy('created_at', 'desc')->get();

        $data = array(
            'title' => 'Edit User',
            'user' => $user,
            'outlets' => $outlets,
        );

        return view('admin.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'outlet_id' => 'required',
            'role' => 'required',
        ]);

        $user = User::findOrFail($id);

        $password1 = $request->password;
        $password2 = $request->password2;

        if ($password1 != null && $password2 != null) {
            if ($password1 == $password2) {
                $input = $request->all();
                $input['password'] = Hash::make($password1);
    
                if ($user->update($input)) {
                    return redirect()->route('users.index')->with('success', 'User has been edited!');
                } else {
                    return redirect()->route('users.index')->with('error', 'Something went wrong!');
                }
            } else {
                return back()->with('error', 'Your password does not match!');
            }   
        } else {
            $input = $request->all();
            $input['password'] = $user->password;

            if ($user->update($input)) {
                return redirect()->route('users.index')->with('success', 'User has been edited!');
            } else {
                return redirect()->route('users.index')->with('error', 'Something went wrong!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->delete()) {
            return back()->with('success', 'User has been deleted!');
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }
}
