<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Models\Addres;
use App\Models\City;
use App\Models\State;
use Illuminate\Support\Facades\Auth;

class HomeAddressController extends Controller
{
    public function Address()
    {
        $Address = Addres::where('user_id','=',Auth::user()->id)
        ->where('is_Delete','=',0)
        ->get();
        $States = State::all();
        return view('Home.Front.Address',[
            'Address' => $Address,
            'States' => $States
        ]);  
    }
    public function newAddress()
    {
        $State = State::where('is_Delete','=',0)
        ->get();
        return response()->json(['AddressFormnew' => AddressFormnew($State)]);
    }
    public function insertAddress(Request $request)
    {
       $Addres = new Addres();   
       $Addres->Name = $request->Name;  
       $Addres->Phone = $request->Phone; 
       $Addres->Mobile = $request->Mobile; 
       $Addres->Address = $request->Address;
       $Addres->ZipCode = $request->ZipCode; 
       $Addres->Plate = $request->Plate; 
       $Addres->Unit = $request->Unit; 
       $Addres->states_id  = $request->State;
       $Addres->cities_id = $request->City;
       $Addres->user_id = Auth::user()->id;
       $Addres->save();
       $Address = Addres::where('user_id','=',Auth::user()->id)->get();
       return response()->json(['AddressUser' => AddressUser($Addres),'AddresSelect' => AddresSelect($Address),'HomeAddress' => HomeAddress($Address)]);
    }
    public function editAddress(Request $request)
    {
        $Address = Addres::find($request->id);
        $State = State::where('is_Delete','=',0)
        ->get();
        $Citys = City::where('states_id','=',$Address->states()->id)
        ->where('is_Delete','=',0)
        ->get();
        return response()->json(['AddressForm' => AddressForm($Address,$State,$Citys)]); 
    }
    public function updatetAddress(AddressRequest $request)
    {
        $Addres = Addres::find($request->id);   
        $Addres->Name = $request->Name;  
        $Addres->Phone = $request->Phone; 
        $Addres->Mobile = $request->Mobile; 
        $Addres->Address = $request->Address;
        $Addres->ZipCode = $request->ZipCode; 
        $Addres->Plate = $request->Plate; 
        $Addres->Unit = $request->Unit; 
        $Addres->states_id  = $request->State;
        $Addres->cities_id = $request->City;
        $Addres->update();
        $Address = Addres::where('user_id','=',Auth::user()->id)
        ->where('is_Delete','=',0)
        ->get();
        return response()->json(['AddressUser' => AddressUser($Addres),'AddresSelect' => AddresSelect($Address),'HomeAddress' => HomeAddress($Address)]);
    }
    public function deleteAddress(Request $request)
    {
        $Addres = Addres::find($request->id);
        $Addres->is_delete = true;
        $Addres->update();
        $Address = Addres::where('user_id','=',Auth::user()->id)
        ->where('is_Delete','=',0)
        ->get();
        return response()->json(['HomeAddress' => HomeAddress($Address)]);
    }
    public function selectStates(Request $request)
    {
        $City = City::where('states_id','=',$request->State)
        ->where('is_Delete','=',0)
        ->get();
        return response()->json(['Citys' => generateCitySelect($City)]);
    }
    public function selectAddress(Request $request)
    {
        $Address = Addres::find($request->id);
        return response()->json(['AddressUser' => AddressUser($Address)]);
    }
}