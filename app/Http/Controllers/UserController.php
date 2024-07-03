<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', ['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'role'=>'required'
        ]);

        $newCust = new User();
        $newCust->name = $request->name;
        $newCust->email = $request->email;
        $newCust->password = Hash::make($request->password); // Encrypt the password
        $newCust->role = $request->role;
        $newCust->save();

        return redirect('users.index')->with('status', 'Sukses');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = User::find($id);
        return view('user.edit', compact('data')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'role'=>'required'
        ]);

        $newCust = new User();
        $newCust->name = $request->get('name');
        $newCust->email = $request->get('email');
        $newCust->password = Hash::make($request->get('password')); // Encrypt the password
        $newCust->role = $request->get('role');
        dd($newCust);
        $newCust->save();

        return redirect('users.index')->with('status', 'Update Successfull');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $custs = User::find($id);
            $custs->delete();
            return redirect()->route('users.index');
        }
        catch(\Throwable $th){
            $msg = "Data tidak dapat dihapus karena sudah digunakan";
            return redirect()->route('users.index')->with('error', $msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = User::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('users.getEditForm', compact('data'))->render()
        ), 200);
    }

    public function deleteData(Request $request)
    {
        $id = $request->id;
        $data = User::find($id);
        $data->delete();
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'type data is removed !'
        ), 200);
    }
}
