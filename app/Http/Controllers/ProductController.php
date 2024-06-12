<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $products=Product::all();
        foreach($products as $product) {
            $directory = public_path('/images/product/'.$product->id);
            if(File::exists($directory))
            {
                $files = File::files($directory);
                $filenames = [];
                foreach ($files as $file) {
                    $filenames[] = $file->getFilename();
                }
                $product['filenames']=$filenames;
            }
        }
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotel = Hotel::all();
        return view ('product.create', ['hotel'=>$hotel]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'hotel_id'=>'required',
            'tipe_kamar'=>'required',
            'price'=>'required',
            'image'=>'required',
            'available_room'=>'required'
        ]);

        $newProduct = new Product();
        $newProduct->name = $request->get('name');
        $newProduct->hotel_id = $request->get('hotel_id');
        $newProduct->tipe_kamar = $request->get('tipe_kamar');
        $newProduct->price = $request->get('price');
        $newProduct->image = $request->get('image');
        $newProduct->available_room = $request->get('available_room');
        $newProduct->save();

        return redirect('product.index')->with('status', 'Sukses');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Product::find($id);

        //dd($data);

        return view("product.show", compact("data"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Product::find($id);
        return view('product.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'hotel_id'=>'required',
            'tipe_kamar'=>'required',
            'price'=>'required',
            'image'=>'required',
            'available_room'=>'required'
        ]);

        $newProduct = Product::find($id);
        $newProduct->name = $request->name;
        $newProduct->hotel_id = $request->hotel_id;
        $newProduct->tipe_kamar = $request->tipe_kamar;
        $newProduct->price = $request->price;
        $newProduct->image = $request->image;
        $newProduct->available_room = $request->available_room;
        $newProduct->save();

        return redirect('product.index')->with('status', 'Update Succesfull');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $products = Product::find($id);
            $products->delete();
            return redirect('product.index');
        }catch(\Throwable $th){
            $msg = "Data tidak dapat dihapus karena sudah digunakan";
            return redirect()->route('product.index')->with('error', $msg);
        }
    }

    public function tampilProduk($id){
        $dataku = Product::retrieveByHotelId($id);
        $productString = '';
        foreach($dataku as $item){
            $productString .=$item->name.', ';
        }
        return response()->json(array(
            'status'=>'oke',
            'msg'=>$productString
          ),200);        
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Product::find($id);
        $hotel = Hotel::find($data->hotel_id);
        $hotels = Hotel::orderBy('name')->get();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('product.getEditForm', compact('data', 'hotel', 'hotels'))->render()
        ), 200);
    }

    public function deleteData(Request $request)
    {
        $id = $request->id;
        $data = Product::find($id);
        $data->delete();
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'type data is removed !'
        ), 200);
    }

    public function uploadPhoto(Request $request) {
        $product_id=$request->product_id;
        $product=Product::find($product_id);
        return view('product.formUploadPhoto',compact('product'));
    }

    public function simpanPhoto(Request $request) {
        $file=$request->file("file_photo");
        $folder='images/product/'.$request->product_id;
        @File::makeDirectory(public_path()."/".$folder);
        $filename=time()."_".$file->getClientOriginalName();
        $file->move($folder,$filename);
        return redirect()->route('product.index')->with('status','photo terupload');
    }

    public function delPhoto(Request $request) {
        File::delete(public_path()."/images/".$request->filepath);
        return redirect()->route('product.index')->with('status','photo dihapus');
    }


    
}
