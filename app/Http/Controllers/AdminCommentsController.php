<?php

namespace App\Http\Controllers;

use App\Models\comments;
use App\Models\Comments_minus;
use App\Models\Comments_plus;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminCommentsController extends Controller
{
    public function commnets(Request $request)
    {
        if ($request->ajax()) {
            $data = comments::where('accept','=',0)
            ->where('is_Delete','=',0)
            ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('User', function($row){
                   return $row->User()->name;
                })
                ->addColumn('action', function($row){
                    return $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn ripple btn-info ShowComment">نمایش کامنت</a>';
                })
                ->rawColumns(['action','User'])
                ->make(true);
            }
        return view('Admin.Front.Comments.Comments');
    }
    public function commnetsShow(Request $request)
    {
        $Comment = comments::find($request->id);
        $Comments_plus = Comments_plus::where('comments_id','=',$Comment->id)->get();
        $Comments_minus = Comments_minus::where('comments_id','=',$Comment->id)->get();

        return response()->json(['getComment' => getComment($Comment,$Comments_plus,$Comments_minus),'id' => $Comment->id]);
    }
    public function commnetAccept(Request $request)
    {
        $Comment = comments::find($request->id);
        $Comment->accept = 1 ;
        $Comment->update();
        return response()->json($Comment);
    }
    public function commnetDelete(Request $request)
    {
        $Comment = comments::find($request->id);
        $Comment->is_Delete = 1;
        $Comment->update();
        return response()->json($Comment);
    }
}
