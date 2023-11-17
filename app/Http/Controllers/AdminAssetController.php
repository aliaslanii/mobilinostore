<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class AdminAssetController extends Controller
{
    public function index(Request $request)
    {
        $Assets = Asset::where('image','=',null)
        ->get();
        if ($request->ajax()) {
            $data = Asset::where('image','!=',null)
            ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function($row){
                    $img = '<img style="width:6rem" class="img-sm product-image border" src='.asset("images/Home-image/$row->image").'>';
                    return $img;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn ripple btn-primary editAsset">ویرایش</a>';
                    return $btn;
                })
                ->rawColumns(['action','image'])
                ->make(true);
            }
        return view('Admin.Front.asset.assets',[
            'Assets' => $Assets
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $Asset = Asset::where('Number','=',$request->Number)->first();
        deleteimgHome($Asset);
        $img = time().$request->img->getClientOriginalName();
        $request->img->move(public_path('images/Home-image'),$img);
        $Asset->image = $img;
        $Asset->update();
        return response()->json(['Asset' => $Asset,'Number' => data_Number()]);
    }

    public function show()
    {
        return response()->json(['Number' => data_Number_show()]);
    }

    public function edit(Request $request)
    {
        return response()->json(['Number' => data_Number_edit($request->id)]);
    }

    public function update(Request $request, string $id)
    {
        
    }
    
    public function destroy(string $id)
    {
        //
    }
}
