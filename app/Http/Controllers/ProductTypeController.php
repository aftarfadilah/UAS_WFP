<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ProductType::all();
        return view('product.type.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['nameType' => 'required']);

        $newType = new ProductType;
        $newType->name = $request->nameType;
        $newType->save();
        return redirect()->route('product.type.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductType $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = ProductType::find($id);
        return view('product.type.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(['nameType' => 'required']);

        $newType = ProductType::find($id);
        $newType->name = $request->nameType;
        $newType->save();
        return redirect()->route('product.type.index')->with('status', 'Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user=Auth::user();
        $this->authorize('delete-permission', $user);

        try {
            $product = ProductType::find($id);
            $product->delete();
            return redirect()->route('type.index');
        } catch (\Throwable $th) {
            $msg = "Data tidak dapat dihapus karena sudah digunakan";
            return redirect()->route('product.type.index')->with('error', $msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = ProductType::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('product.type.getEditForm', compact('data'))->render()
        ), 200);
    }

    public function deleteData(Request $request)
    {
        $id = $request->id;
        $data = ProductType::find($id);
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
