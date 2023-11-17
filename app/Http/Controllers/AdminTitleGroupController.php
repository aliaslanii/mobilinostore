<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Titlegroups;
use Illuminate\Http\Request;

class AdminTitleGroupController extends Controller
{
    public function TitleGroups(Request $request)
    {
        if ($request->ajax()) {
            $data = Titlegroups::where('is_Delete','=',0)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('Categorys', function($row){
                    return '<div>'.$row->category()->Name.'</div>';
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn ripple btn-info editTitleGroup"><ion-icon class="btnaction" name="create-outline"></ion-icon></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-id='.$row->id.' class="btn ripple btn-danger ms-2 deleteTitleGroup"><ion-icon name="trash-outline"></ion-icon></a>';
                    return $btn;
                })
                ->rawColumns(['action','Categorys'])
                ->make(true);
            }
        return view('Admin.Front.TitleGroup.TitleGroups');
    }
    public function TitleGroupCreate()
    {
        return response()->json(CT());
    }
    public function insertTitleGroup(Request $request)
    {
       $Titlegroup = new Titlegroups();
       $Titlegroup->title = $request->title;
       $Titlegroup->category_id = $request->Category;
       $Titlegroup->save();
       return response()->json($Titlegroup);
    }

    public function EditeTitleGroup(Request $request)
    {
        $Titlegroup = Titlegroups::find($request->id);
        return response()->json(['Titlegroup' => $Titlegroup ,'Categorys' => FCT($Titlegroup)]);
    }
    
    public function UpdateTitleGroup(Request $request)
    {
        $Titlegroup  = Titlegroups::find($request->id);
        $Titlegroup->title = $request->title;
        $Titlegroup->category_id = $request->Category;
        $Titlegroup->update();
        return response()->json($Titlegroup);
    }

    public function DeleteTitleGroup(Request $request)
    {
        $Titlegroup  = Titlegroups::find($request->id);
        $Titlegroup->is_Delete = true;
        $Titlegroup->update();
        return response()->json($Titlegroup);
    }
}
