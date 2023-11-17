<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminStateCityController extends Controller
{
    public function stateCity(Request $request)
    {
        if ($request->ajax()) {
            $data = State::where('is_Delete','=',0)
            ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn ripple btn-primary ShowCity">نمایش شهر ها</a>';
                    $btn = $btn . '<a href="javascript:void(0)"  data-id="'.$row->id.'" class="btn ripple btn-warning AddCity ms-4">افزودن شهر</a>';
                    $btn = $btn . '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn ripple btn-danger deleteState ms-4">حذف استان</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        return view('Admin.Front.State&City.StateCity'); 
    }

    public function showCity(Request $request)
    {
        $City = City::where('states_id','=',$request->id)
        ->where('is_Delete','=',0)
        ->get();
        $State = State::find($request->id);
        return response()->json(['Citys' => getCity($City),'State' => $State->State]);
    }
    public function deleteCity(Request $request)
    {
        $City = City::find($request->id);
        $City->is_Delete = true;
        $City->update();
        $Citys = City::where('states_id','=',$request->State)
        ->where('is_Delete','=',0)
        ->get();
        return response()->json(['Citys' => getCity($Citys)]);
    }
    public function selectState(Request $request)
    {
        $State = State::find($request->id);
        return response()->json(['State' => $State->State]);
    }
    public function insertCity(Request $request)
    {
        $City = new City();
        $City->City = $request->City;
        $City->states_id = $request->State_id;
        $City->save();
        return response()->json(['City' => $City]);
    }
    public function insertState(Request $request)
    {
        $State = new State();
        $State->State = $request->State;
        $State->save();
        return response()->json(['State' => $State]);
    }
    public function deleteState(Request $request)
    {
        $State = State::find($request->id);
        $State->is_Delete = true;
        $State->update();
        return response()->json($State);
    }
}
