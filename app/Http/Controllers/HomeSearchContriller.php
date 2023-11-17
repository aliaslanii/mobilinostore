<?php

namespace App\Http\Controllers;

use App\Models\Berands;
use App\Models\Category;
use App\Models\Colors;
use App\Models\Groups;
use App\Models\GroupsProducts;
use App\Models\Products;
use App\Models\ProductsTitlegroups;
use App\Models\Titlegroups;
use Illuminate\Http\Request;

class HomeSearchContriller extends Controller
{
    public function search(Request $request)
    {
        $Products = Products::where('is_Delete','=',0)
        ->where('SumNumber','>',0)
        ->where('title','like','%'.$request->q.'%')
        ->orderBy('favorite','desc')
        ->paginate(12);
        return view('Home.Front.Search',[
            'Products' => $Products,
            'q' => $request->q
        ]);
    }
    public function searchBerands($id)
    {
        $Berand = Berands::find($id);
        $Products = Products::where('is_Delete','=',0)
        ->where('SumNumber','>',0)
        ->where('berand_id','=',$Berand->id)
        ->paginate(12);
        $q = $Berand->Name;
        return view('Home.Front.Search',[
            'Products' => $Products,
            'q' => $q,
        ]);
    }
    public function searchCategory($id)
    {
        $Category = Category::find($id);
        $Products = Products::where('is_Delete','=',0)
        ->where('SumNumber','>',0)
        ->where('categories_id','=',$Category->id)
        ->paginate(12);
        $q = $Category->Name;
        return view('Home.Front.Search',[
            'Products' => $Products,
            'q' => $q,
        ]);
    }
    public function searchTitleGroup($id)
    {
        $TitleGroup = Titlegroups::find($id);
        $ProductsTitlegroups = ProductsTitlegroups::where('titlegroups_id','=',$TitleGroup->id)
        ->get();
        foreach($ProductsTitlegroups as $ProductsTitlegroup)
        {
            if($ProductsTitlegroup->Products()->is_Delete == 0)
            {
                $data[] = $ProductsTitlegroup->Products();
            } 
        }
        if(isset($data))
        {
            $Products = Paginator_Products($data);
        }else{
            $Products = null;
        }
        $q = $TitleGroup->title;
        return view('Home.Front.SearchTitleGroups',[
            'Products' => $Products,
            'q' => $q,
        ]);
    }
    public function searchGroups($id)
    {
        $Groups = Groups::find($id);
        $GroupsProducts = GroupsProducts::where('groups_id','=',$Groups->id)
        ->get();
        foreach($GroupsProducts as $GroupsProduct)
        {
            if($GroupsProduct->Products()->is_Delete == 0)
            {
                $data[] =  $GroupsProduct->Products();
            } 
        }
        if(isset($data))
        {
            $Products = Paginator_Products($data);
        }else{
            $Products = null;
        }
        $q = $Groups->title;
        return view('Home.Front.SearchTitleGroups',[
            'Products' => $Products,
            'q' => $q,
        ]);
    }
}