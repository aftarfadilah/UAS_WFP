<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::all();
        return view('hotel.index', ['dataku'=>$hotels]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('hotel.create', ['types'=>$types]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['nameType' => 'required',
                            'addressType' => 'required',
                            'cityType' => 'required',
                            'stateType'=> 'required',
                            'countryType'=> 'required',
                            'emailType'=> 'required',
                            'accommodationType'=> 'required',
                            'categoryType'=> 'required',
                            'type_id'=> 'required']);


        $newData = new Hotel();
        $newData->name = $request->nameType;
        $newData->address = $request->addressType;
        $newData->city = $request->cityType;
        $newData->state = $request->stateType;
        $newData->country_id = $request->countryType;
        $newData->email = $request->emailType;
        $newData->accommodation_type = $request->accommodationType;
        $newData->category = $request->categoryType;
        $newData->type_id = $request->type_id;

        $newData->save();
        return redirect()->route('hotel.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Hotel::find($id);
        $types = Type::all();
        return view('hotel.edit', compact('data', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(['nameType' => 'required',
                            'addressType' => 'required',
                            'cityType' => 'required',
                            'stateType'=> 'required',
                            'countryType'=> 'required',
                            'emailType'=> 'required',
                            'accommodationType'=> 'required',
                            'categoryType'=> 'required',
                            'type_id'=> 'required']);


        $newData = Hotel::find($id);
        $newData->name = $request->nameType;
        $newData->address = $request->addressType;
        $newData->city = $request->cityType;
        $newData->state = $request->stateType;
        $newData->country_id = $request->countryType;
        $newData->email = $request->emailType;
        $newData->accommodation_type = $request->accommodationType;
        $newData->category = $request->categoryType;
        $newData->type_id = $request->type_id;

        $newData->save();
        return redirect()->route('hotel.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user=Auth::user();
        $this->authorize('delete-hotel-permission', $user);

        try{
            $hotel = Hotel::find($id);
            $hotel->delete();
            return redirect()->route('hotel.index');
        }
        catch(\Throwable $th){
            $msg = "Data tidak dapat dihapus karena sudah digunakan";
            return redirect()->route('hotel.index')->with('error', $msg);
        }
       
        
    }

    public function availableHotelRoom()
    {
        $data = Hotel::join('products as p', 'hotels.id', '=', 'p.hotel_id')
                ->select('hotels.id', 'hotels.name', DB::raw('sum(p.available_room) as room'))
                ->groupBy('hotels.id', 'hotels.name')
                ->get();
        //dd($data);

        return view('hotel.availableRoom', compact('data'));
    }

    public function avgHotelPrice() {

        $data = Type::rightJoin('hotels as h', 'types.id', '=', 'h.type_id')
        ->leftJoin('products as p', 'h.id', '=','p.hotel_id' )
        ->select('types.name as namet','h.name', DB::raw('avg(p.price) as avg_price'))
        ->groupBy('types.name', 'h.name')
        ->get();

        return view('hotel.avgHotelPrice', compact('data'));
    }

    public function showProduk() {
        $hotel = Hotel::find($_GET['hotel_id']);
        $name = $hotel->name;
        $data = $hotel->products;
        return response()->json(array(
            'status'=>'Ok',
            'msg'=>view('hotel.showProduk', compact('name', 'data'))->render()
        ),200);
    }

    public function uploadLogo(Request $request) {
        $hotel_id=$request->hotel_id;
        $hotel=Hotel::find($hotel_id);
        return view('hotel.formUploadLogo',compact('hotel'));
    }

    public function simpanLogo(Request $request) {
        $file=$request->file("file_logo");
        $folder='logo';
        $filename=$request->hotel_id . ".jpg";
        $file->move($folder,$filename);
        return redirect()->route('hotel.index')->with('status','logo terupload');
    }

    public function uploadPhoto(Request $request) {
        $hotel_id=$request->hotel_id;
        $hotel=Hotel::find($hotel_id);
        return view('hotel.formUploadPhoto',compact('hotel'));
    }

    public function simpanPhoto(Request $request) {
        $file=$request->file("file_photo");
        $folder='images';
        $filename=time()."_".$file->getClientOriginalName();
        $file->move($folder,$filename);
        $hotel=Hotel::find($request->hotel_id);
        $hotel->image=$filename;
        $hotel->save();
        return redirect()->route('hotel.index')->with('status','photo terupload');
    }

}
