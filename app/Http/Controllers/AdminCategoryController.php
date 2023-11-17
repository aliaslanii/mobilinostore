<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;

class AdminCategoryController extends Controller
{
    public function Categorys(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::where('is_Delete','=',0)->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('img', function($row){
                        $img = '<img class="img-sm product-image border" src='.asset("images/Category-image/$row->img").'>';
                        return $img;
                    })
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn ripple btn-info editCategory"><ion-icon class="btnaction" name="create-outline"></ion-icon></a>';
                        $btn = $btn.'<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn ripple btn-danger ms-2 deleteCategory"><ion-icon  name="trash-outline"></ion-icon></a>';
                        return $btn;
                    })
                    ->rawColumns(['action','img'])
                    ->setRowClass('border-bottom')
                    ->make(true);
                }
        return view('Admin.Front.Category.Categorys');
    }
    public function insertCategory(Request $request)
    {
        $path = 'images/Category-image';
        $Category = new Category();
        $Category->Name = $request->Name;
        $Category->img = moveimg($request,$path);
        $Category->Description = $request->Description;
        $Category->showhome = $request->showhome ?? 0;
        $Category->save();
        return response()->json($Category);          
    }

    public function EditeCategory(Request $request)
    { 
        $Category = Category::find($request->id);
        return response()->json(['Category' => $Category,'img' => getImgCategory($Category->img)]);
    }
    public function UpdateCategory(Request $request)
    {
        $Category = Category::find($request->id);
        $Category->Name = $request->Name;
        $Category->Description = $request->Description;
        $Category->img = dmiimgCategory($request,$Category);
        $Category->showhome = $request->showhome ?? 0;
        $Category->update();
        return response()->json($Category);   
    }
    public function DeleteCategory(Request $request)
    {
        $Category = Category::find($request->id);
        $Category->is_Delete = true;
        $Category->update();
        return response()->json($Category);   
    }
    public function DeleteCategoryimg(Request $request)
    {
        $Category = Category::find($request->id);
        File::delete('images/Category-image/'.$Category->img);
        $Category->img = 'default.png';
        $Category->update();
        return response()->json($Category);   
    }
}
