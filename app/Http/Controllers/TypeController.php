<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Type::all();
        return view('type.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['nameType' => 'required']);

        $newType = new Type;
        $newType->name = $request->nameType;
        $newType->save();
        return redirect()->route('type.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Type::find($id);
        return view('type.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(['nameType' => 'required']);

        $newType = Type::find($id);
        $newType->name = $request->nameType;
        $newType->save();
        return redirect()->route('type.index')->with('status', 'Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user=Auth::user();
        $this->authorize('delete-permission', $user);

        try {
            $hotel = Type::find($id);
            $hotel->delete();
            return redirect()->route('type.index');
        } catch (\Throwable $th) {
            $msg = "Data tidak dapat dihapus karena sudah digunakan";
            return redirect()->route('type.index')->with('error', $msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Type::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('type.getEditForm', compact('data'))->render()
        ), 200);
    }

    public function deleteData(Request $request)
    {
        $id = $request->id;
        $data = Type::find($id);
        $data->delete();
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'type data is removed !'
        ), 200);
    }

    // public function getEditFormB(Request $request)
    // {
    //     $id = $request->id;
    //     $data = Type::find($id);
    //     return response()->json(array(
    //         'status' => 'oke',
    //         'msg' => view('type.getEditFormB', compact('data'))->render()
    //     ), 200);
    // }

    // public function saveDataTD(Request $request)
    // {
    //     $id = $request->id;
    //     $data = Type::find($id);
    //     $data->name = $request->name;
    //     $data->save();
    //     return response()->json(array(
    //         'status' => 'oke',
    //         'msg' => 'type data is up-to-date !'
    //     ), 200);
    // }
}
