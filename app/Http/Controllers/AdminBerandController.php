<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berands;
use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;

class AdminBerandController extends Controller
{
    public function Berands(Request $request)
    {
        if ($request->ajax()) {
            $data =  Berands::where('is_Delete','=',0)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('Category', function($row){
                    $btnCategory = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-primary btn-sm ShowCategorys">نمایش دسته بندی ها</a>';
                    return  $btnCategory ;
                })
                ->addColumn('img', function($row){
                    $img = '<img style="width:6rem" class="img-sm product-image border" src='.asset("images/Berands-image/$row->img").'>';
                    return $img;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn ripple btn-info editBerand"><ion-icon class="btnaction" name="create-outline"></ion-icon></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-id='.$row->id.' class="btn ripple btn-danger ms-2 deleteBerand"><ion-icon name="trash-outline"></ion-icon></a>';
                    return $btn;
                })
                ->rawColumns(['action','Category','img'])
                ->make(true);
        }
        return view('Admin.Front.Berand.Berands');
    }
    public function getBerandCategorys()
    {
        return response()->json(GCB());
    }
    public function BerandCategorys(Request $request)
    {
        $Berand = Berands::find($request->id);
        $data = CBF($Berand);
        return response()->json($data);
    }
    public function insertBerand(Request $request)
    {
        $path = 'images/Berands-image';
        $Berand = new Berands();
        $Berand->Name = $request->Name;
        $Berand->is_show = $request->is_show ??0;
        $Berand->Description = $request->Description;
        $Berand->img = moveimg($request, $path);
        $Berand->save();
        $Berand->Categorys()->attach($request->Categorys);
        return response()->json($Berand);
    }
    public function EditeBerand(Request $request)
    {
        $Berand = Berands::find($request->id);
        return response()->json(['Berand' => $Berand , 'img'=> getImgBerand($Berand->img) , 'Categorys' => CBC($Berand)]);
    }
    public function UpdateBerand(Request $request)
    {
        $path = 'images/Berands-image';
        $Berand = Berands::find($request->id);
        $Berand->Name = $request->Name;
        $Berand->is_show = $request->is_show ?? 0;
        $Berand->Description = $request->Description;
        $Berand->img = dmiimgBerand($request,$path,$Berand);
        $Berand->update();
        $Berand->Categorys()->sync($request->Categorys);
        return response()->json($Berand);
    }
    public function DeleteBerand(Request $request)
    {
        $Berand = Berands::find($request->id);
        $Berand->is_Delete = true;
        $Berand->update();
        return response()->json($Berand);
    }
}
