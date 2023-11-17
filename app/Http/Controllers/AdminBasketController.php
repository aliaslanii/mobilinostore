<?php

namespace App\Http\Controllers;

use App\Models\Baskets;
use Generator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminBasketController extends Controller
{
    public function baskets(Request $request)
    {
        $Basket = Baskets::where('is_Delete','=',0) 
        ->first('Status','!=',0)
        ->get();
        if ($request->ajax()) {
            $data = Baskets::where('is_Delete','=',0)
            ->where('Status','!=',0)
            ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('User', function($row){
                    return $User = $row->User()->name;						
                })
                ->addColumn('Status', function($row){
                    if($row->Status == 1){
                        $Status = 'درحال پردازش سفارش';
                    }elseif($row->Status == 2){
                        $Status = 'خروج از انبار';
                    }elseif($row->Status == 3){
                        $Status = 'ارسال شده';
                    }elseif($row->Status == 4){
                        $Status = 'لغو شده';
                    }
                    return $Status;						
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn ripple btn-info BasketsShow">نمایش سبد</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-id='.$row->id.' class="btn ripple btn-danger ms-2 Basketscancel">لغو سبد</a>';
                    return $btn;
                })
                ->rawColumns(['action','User','Status'])
                ->make(true);
            }
        return view('Admin.Front.Baskets.Baskets',[
            'Basket' => $Basket,
            'route' => route('Baskets'),
        ]);  
    }
    public function basketsCancel(Request $request)
    {
        if ($request->ajax()) {
            $data = Baskets::where('is_Delete','=',0)
            ->where('Status','=',4)
            ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('User', function($row){
                    return $User = $row->User()->name;						
                })
                ->addColumn('Status', function($row){
                    if($row->Status == 1){
                        $Status = 'درحال پردازش سفارش';
                    }elseif($row->Status == 2){
                        $Status = 'خروج از انبار';
                    }elseif($row->Status == 3){
                        $Status = 'ارسال شده';
                    }elseif($row->Status == 4){
                        $Status = 'لغو شده';
                    }
                    return $Status;						
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn ripple btn-info BasketsShow">نمایش سبد</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-id='.$row->id.' class="btn ripple btn-danger ms-2 Basketscancel">لغو سبد</a>';
                    return $btn;
                })
                ->rawColumns(['action','User','Status'])
                ->make(true);
            }
        return view('Admin.Front.Baskets.Baskets',[
            'route' => route('Basketscancel'),
        ]);  
    }
    public function basketspaydone(Request $request)
    {
        if ($request->ajax()) {
            $data = Baskets::where('is_Delete','=',0)
            ->where('Status','=',2)
            ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('User', function($row){
                    return $User = $row->User()->name;						
                })
                ->addColumn('Status', function($row){
                    if($row->Status == 1){
                        $Status = 'درحال پردازش سفارش';
                    }elseif($row->Status == 2){
                        $Status = 'خروج از انبار';
                    }elseif($row->Status == 3){
                        $Status = 'ارسال شده';
                    }elseif($row->Status == 4){
                        $Status = 'لغو شده';
                    }
                    return $Status;						
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn ripple btn-info BasketsShow">نمایش سبد</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-id='.$row->id.' class="btn ripple btn-danger ms-2 Basketscancel">لغو سبد</a>';
                    return $btn;
                })
                ->rawColumns(['action','User','Status'])
                ->make(true);
            }
        return view('Admin.Front.Baskets.Baskets',[
            'route' => route('Basketspaydone'),
        ]);  
    }
    public function basketssend(Request $request)
    {
        if ($request->ajax()) {
            $data = Baskets::where('is_Delete','=',0)
            ->where('Status','=',3)
            ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('User', function($row){
                    return $User = $row->User()->name;						
                })
                ->addColumn('Status', function($row){
                    if($row->Status == 1){
                        $Status = 'درحال پردازش سفارش';
                    }elseif($row->Status == 2){
                        $Status = 'خروج از انبار';
                    }elseif($row->Status == 3){
                        $Status = 'ارسال شده';
                    }elseif($row->Status == 4){
                        $Status = 'لغو شده';
                    }
                    return $Status;						
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn ripple btn-info BasketsShow">نمایش سبد</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-id='.$row->id.' class="btn ripple btn-danger ms-2 Basketscancel">لغو سبد</a>';
                    return $btn;
                })
                ->rawColumns(['action','User','Status'])
                ->make(true);
            }
        return view('Admin.Front.Baskets.Baskets',[
            'route' => route('Basketssend'),
        ]);  
    }
    
    public function basketsShow(Request $request)
    {
        $Basket = Baskets::where('is_Delete','=',0)
        ->where('id','=',$request->id)
        ->first();
        return response()->json(['BasketsShow' => generatBasketsProducts($Basket)]);  
    }
    public function ExitBasket(Request $request)
    {
        $Basket = Baskets::where('is_Delete','=',0)
        ->where('id','=',$request->id)
        ->first();
        $Basket->exit = 1;
        $Basket->Status = 2;
        $Basket->update();
        return response()->json('Done');
    }
    public function cancelBasket(Request $request)
    {
        $Basket = Baskets::where('is_Delete','=',0)
        ->where('id','=',$request->id)
        ->first();
        $Basket->cancel = 1;
        $Basket->Status = 4;
        $Basket->update();
        return response()->json('Done');
    } 
}
