<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $custs = Customer::all();
        return view ('customer.index', ['data'=>$custs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'address'=>'required'
        ]);

        $newCust = new Customer();
        $newCust->name = $request->get('name');
        $newCust->address = $request->get('address');
        $newCust->save();

        return redirect('customer.index')->with('status', 'Sukses');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Customer::find($id);
        return view('customer.edit', compact('data')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'address'=>'required'
        ]);

        $newCust = Customer::find($id);
        $newCust->name = $request->name;
        $newCust->address = $request->address;
        $newCust->save();

        return redirect('customer.index')->with('status', 'Update Successfull');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $custs = Customer::find($id);
            $custs->delete();
            return redirect()->route('customer.index');
        }
        catch(\Throwable $th){
            $msg = "Data tidak dapat dihapus karena sudah digunakan";
            return redirect()->route('customer.index')->with('error', $msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Customer::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('customer.getEditForm', compact('data'))->render()
        ), 200);
    }

    public function deleteData(Request $request)
    {
        $id = $request->id;
        $data = Customer::find($id);
        $data->delete();
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'type data is removed !'
        ), 200);
    }
}
