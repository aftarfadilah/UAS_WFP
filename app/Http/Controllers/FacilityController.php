<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Product;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facilities = Facility::all();
        return view('facilities.index', compact('facilities'));
    }
    
    public function create()
    {
        $products = Product::all();
        return view('facilities.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'product_id' => 'required',
            'description' => 'nullable|string',
        ]);

        Facility::create($request->all());

        return redirect()->route('facilities.index')->with('success', 'Facility created successfully.');
    }
    public function edit(Facility $facility)
    {
        $facility = Facility::find($facility->id);
        $products = Product::all();
        return view('facilities.edit', compact('facility', 'products'));
    }

    
    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'product_id' => 'required',
            'description' => 'nullable|string',
        ]);

        $facility->update($request->all());

        return redirect()->route('facilities.index')->with('success', 'Facility updated successfully.');
    }
    public function destroy(Facility $facility)
    {
        $facility->delete();

        return redirect()->route('facilities.index')->with('success', 'Facility deleted successfully.');
    }


    
}

