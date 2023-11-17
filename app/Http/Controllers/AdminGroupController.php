<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groups;
use Yajra\DataTables\Facades\DataTables;

class AdminGroupController extends Controller
{
    public function Groups(Request $request)
    {
        if ($request->ajax()) {
            $data = Groups::where('is_Delete','=',0)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('titlegroup', function($row){
                    return '<div>'.$row->Titlegroups()->title.'</div>';
                })
                ->addColumn('Categorys', function($row){
                    return '<div>'.$row->Titlegroups()->category()->Name.'</div>';
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn ripple btn-info editGroup"><ion-icon class="btnaction" name="create-outline"></ion-icon></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-id='.$row->id.' class="btn ripple btn-danger ms-2 deletGroup"><ion-icon name="trash-outline"></ion-icon></a>';
                    return $btn;
                })
                ->rawColumns(['action','titlegroup','Categorys'])
                ->make(true);
            }
        return view('Admin.Front.Group.Groups');
    }

    public function CreateGroup()
    {
        return response()->json(TT());
    }

    public function insertGroup(Request $request)
    {
       $Group = new Groups();
       $Group->title = $request->title;
       $Group->titlegroups_id = $request->titlegroup;
       $Group->save();
       return response()->json($Group);
    }

    public function EditeGroup(Request $request)
    {
        $Group = Groups::find($request->id);
        return response()->json(['Group' => $Group ,'Categorys' => FTT($Group)]);
    }
    
    public function UpdateGroup(Request $request)
    {
        $Group  = Groups::find($request->id);
        $Group->title = $request->title;
        $Group->titlegroups_id = $request->titlegroup;
        $Group->update();
        return response()->json($Group);
    }

    public function DeleteGroup(Request $request)
    {
        $Group = Groups::find($request->id);
        $Group->is_Delete = true;
        $Group->update();
        return response()->json($Group);
    }
    
}
