<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminMessageController extends Controller
{
    public function messages(Request $request)
    {
        if ($request->ajax()) {
            $data = $messages = ContactUs::where('is_Delete','=',0)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn ripple btn-danger deletemessages"><ion-icon name="trash-outline"></ion-icon></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        return view('Admin.Front.messages.messages');        
    }
    public function deleteMessages(Request $request)
    {
        $messages = ContactUs::find($request->id);
        $messages->is_Delete = true;
        $messages->update();
        return response()->json($messages);       
    }
}
