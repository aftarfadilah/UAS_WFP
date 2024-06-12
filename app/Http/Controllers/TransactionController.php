<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Transaction::all();
        // dd($data);
        $products = Product::all();
        $users = User::orderBy('name')->get();
        $customers = Customer::orderBy('name')->get();
        return view('transaction.index', compact('transaction', 'users', 'customers', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $products = Product::all();
        $users = User::orderBy('name')->get();
        $customers = Customer::orderBy('name')->get();
        return view("transaction.create", compact('users', 'customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id'=>'required',
            'user_id'=>'required',
            'transaction_date'=>'required'
        ]);

        $newTrans = new Transaction();
        $newTrans->customer_id = $request->get('customer_id');
        $newTrans->user_id = $request->get('user_id');
        $newTrans->transaction_date = $request->get('transaction_date');
        $newTrans->save();

        return redirect('transaction.index')->with('status', 'Sukses');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Transaction::find($id);
        return view ('transaction.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id'=>'required',
            'user_id'=>'required',
            'transaction_date'=>'required'
        ]);

        $newTrans = Transaction::find($id);
        $newTrans->customer_id = $request->customer_id;
        $newTrans->user_id = $request->user_id;
        $newTrans->transaction_date = $request->transaction_date;
        $newTrans->save();

        return redirect('transaction.index')->with('status', 'Sukses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $trans = Transaction::find($id);
            $trans->delete();
            return redirect()->route('transaction.index');
        }
        catch(\Throwable $th){
            $msg = "Data tidak dapat dihapus karena sudah digunakan";
            return redirect()->route('transaction.index')->with('error', $msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Transaction::find($id);
        $products = Product::all();
        $users = User::orderBy('name')->get();
        $customers = Customer::orderBy('name')->get();
        $productTransaction = $data->products()->first();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('transaction.getEditForm', compact('data', 'products', 'users', 'customers', 'productTransaction'))->render()
        ));
    }

    public function deleteData(Request $request)
    {
        $id = $request->id;
        $data = Transaction::find($id);
        $data->delete();
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'type data is removed !'
        ), 200);
    }
}
