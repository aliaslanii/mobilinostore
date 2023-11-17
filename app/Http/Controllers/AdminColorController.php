<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colors;
use Yajra\DataTables\Facades\DataTables;

class AdminColorController extends Controller
{
    public function Colors(Request $request)
    {
        if ($request->ajax()) {
            $data = Colors::where('is_Delete','=',0)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('Color', function($row){
                    $Color = '<div><label class="colorinput">
                    <input class="colorinput-input">
                    <span class="colorinput-color border" style="background-color:'.$row->Color.';">
                    </span></label></div>';							
                    return $Color;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn ripple btn-info editColor"><ion-icon class="btnaction" name="create-outline"></ion-icon></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-id='.$row->id.' class="btn ripple btn-danger ms-2 deletColor"><ion-icon name="trash-outline"></ion-icon></a>';
                    return $btn;
                })
                ->rawColumns(['action','Color'])
                ->make(true);
            }
        return view('Admin.Front.Color.Colors');
    }
    public function insertColor(Request $request)
    {
        $Color = new Colors();
        $Color->Name = $request->Name;
        $Color->Color = $request->Color;
        $Color->save();
        return response()->json();
    }
    public function EditeColor(Request $request)
    {
        $Color = Colors::find($request->id);
        return response()->json($Color);
    }
    public function UpdateColor(Request $request)
    {
        $Color = Colors::find($request->id);
        $Color->Name = $request->Name;
        $Color->Color = $request->Color;
        $Color->update();
        return response()->json($Color);
    }
    public function DeleteColor(Request $request)
    {
        $Color = Colors::find($request->id);
        $Color->is_Delete = true;
        $Color->update();
        return response()->json($Color);
    }
}
