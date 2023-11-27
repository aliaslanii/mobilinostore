<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Berands;
use App\Models\Category;
use App\Models\ColorNumberPrice;
use App\Models\Colors;
use App\Models\Discount;
use App\Models\Groups;
use App\Models\GroupsProducts;
use App\Models\Images;
use App\Models\Products;
use App\Models\ProductsTitlegroups;
use App\Models\Suggestion;
use App\Models\TempFile;
use App\Models\Titlegroups;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function Products(Request $request)
    {
        if ($request->ajax()) {
            $data = Products::where('is_Delete','=',0)
            ->where('Show','=',1)
            ->get(); 
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('CNP', function($row){
                    $CNP = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-primary btn-sm ShowCNP">نمایش جزئیات</a>';
                    return  $CNP ;
                })
                ->addColumn('Berand', function($row){
                    $Berand = $row->Berand()->Name;
                    return $Berand;
                })
                ->addColumn('Category', function($row){
                    $Category = $row->categories()->Name;
                    return $Category;
                })
                ->addColumn('img', function($row){
                    $img = '<img style="height:5rem;width: auto !important;" class="img-sm product-image border" src="'.asset("images/Products-image/".$row->img).'" />'; 
                    return $img;
                })
                ->addColumn('details', function($row){
                    $details = '<a href="javascript:void(0)" data-id='.$row->id.' class="btn ripple btn-info detailsProduct">جزئیات</a>';
                    return $details;
                }) 
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-id='.$row->id.' class="btn ripple btn-danger ms-2 deleteProduct"><ion-icon name="trash-outline"></ion-icon></a>';
                    $btn = $btn. '<div class="inline mr-3">
                        <a href="javascript:void(0)" class="inline option-dots" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <ion-icon class="icone-ellipsis" name="ellipsis-vertical-outline"></ion-icon></a>
                        <div class="dropdown-menu dropdown-menu-left" style="padding: 1rem;border-radius: 1rem;">
                        <a class="dropdown-item" href="'.route("Editeinfo",["id" => $row->id ]).'">ویرایش اطلاعات اولیه</a>
                        <a class="dropdown-item" href="'.route("Editeimage",["id" => $row->id ]).'">ویرایش تصاویر </a>
                        <a class="dropdown-item" href="'.route("EditeColor",["id" => $row->id ]).'">ویرایش رنگ</a>
                        <a class="dropdown-item" href="'.route("EditeDetail",["id" => $row->id ]).'">ویرایش جزئیات</a></div></div>';
                    return $btn;
                })
                ->rawColumns(['action','Category','img','details','Berand','CNP'])
                ->make(true);
        }
        return view('Admin.Front.Product.Products');
    }

    public function CreateProduct()
    {
        $Titlegroups = Titlegroups::where('is_Delete','=',0)->get();
        $Groups = Groups::where('is_Delete','=',0)->get();
        $Berands = Berands::where('is_Delete','=',0)->get();
        $Categorys = Category::where('is_Delete','=',0)->get();
        $Colors = Colors::where('is_Delete','=',0)->get();
        return view('Admin.Front.Product.ProductCreate',[
            'Categorys' => $Categorys,
            'Colors' => $Colors,
            'Berands' => $Berands,
            'Titlegroups' => $Titlegroups ,
            'Groups' => $Groups,
        ]);
    }
    public function defectiveProducts(Request $request)
    {
        if ($request->ajax()) {
            $data = Products::where('is_Delete','=',0)
            ->where('Show','=',0)
            ->get(); 
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('CNP', function($row){
                    $CNP = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-primary btn-sm ShowCNP">نمایش جزئیات</a>';
                    return  $CNP ;
                })
                ->addColumn('Berand', function($row){
                    $Berand = $row->Berand()->Name;
                    return $Berand;
                })
                ->addColumn('Category', function($row){
                    $Category = $row->categories()->Name;
                    return $Category;
                })
                ->addColumn('img', function($row){
                    $img = '<img style="height:5rem;" class="img-sm product-image border" src="'.asset("images/Products-image/".$row->img).'" />'; 
                    return $img;
                })
                ->addColumn('details', function($row){
                    $details = '<a href="javascript:void(0)" data-id='.$row->id.' class="btn ripple btn-info detailsProduct">جزئیات</a>';
                    return $details;
                }) 
                ->addColumn('action', function($row){
                    $btn ='<a href="'.route("EditeProduct",['id' => $row->id]).'" class="btn ripple btn-warning"><ion-icon class="btnaction" name="create-outline"></ion-icon></a>';
                    $btn = $btn.'<a href="javascript:void(0)" data-id='.$row->id.' class="btn ripple btn-danger ms-2 deleteProduct"><ion-icon name="trash-outline"></ion-icon></a>';
                    return $btn;
                })
                ->rawColumns(['action','Category','img','details','Berand','CNP'])
                ->make(true);
        }
        return view('Admin.Front.Product.ProductsDefective');
    }
    public function detailsProduct(Request $request)
    {
        $Product = Products::find($request->id);
        return response()->json(CNP($Product));
    }
    public function insertProduct(Request $request)
    {
        if(CSI($request) != false)
        {
            $Product = new Products();
            $Product->Name =$request->Name;
            $Product->title = $request->title;
            $Product->send = $request->send;
            $Product->categories_id = $request->Category ?? null;
            $Product->berand_id = $request->Berand ?? null;
            $Product->save();
            insertid($Product);
            return response()->json(['CPN' => CSI($request),'id' => $Product->id]);
        }
        else{
            return response()->json(false);
        }       
    }
    public function UpdateProduct(Request $request)
    {
        try {
            $Product = Products::find($request->id);
            $Product->Name =$request->Name;
            $Product->title = $request->title;
            $Product->send = $request->send;
            $Product->categories_id = $request->Category ?? null;
            $Product->berand_id = $request->Berand ?? null;
            $Product->update();
            return redirect(route('Products'))->with('success','عملیات با موفقیت انجام شد');
        } catch (Exception) {
            return redirect(route('Products'))->with('error','مشکلی به وجود آمده است مجدد تلاش کنید');
        }
    }
    public function setCPN(Request $request)
    {
        try {
            $Product = Products::find($request->id);
            DeleteoldCPN($Product);
            $Colors = $request->Colors;
            $Prices = $request->Prices;
            $Numbers = $request->Numbers;
            $minCount = min(count($Colors), count($Prices),count($Numbers));
            for ($i = 0; $i < $minCount; $i++) {
                $Color = $Colors[$i];
                $Price = $Prices[$i];
                $Number = $Numbers[$i];
                $ColorNumberPrice = new ColorNumberPrice();
                $ColorNumberPrice->products_id = $Product->id;
                $ColorNumberPrice->color_id = $Color;
                $ColorNumberPrice->number = $Number;
                $ColorNumberPrice->price = $Price;
                $ColorNumberPrice->save();
            }
            SumNumber($Product);
            return redirect(route('Products'))->with('success','عملیات با موفقیت انجام شد');
        } catch (Exception) {
            return redirect(route('Products'))->with('error','مشکلی به وجود آمده است مجدد تلاش کنید');
        } 
    }
    public function setDSP(Request $request)
    {
        try {
            $Product = Products::find($request->id);
            DeleteoldSpecification($Product);
            insertSPV($request,$Product);
            $Product->Titlegroups()->attach($request->Titlegroups);
            $Product->Groups()->attach($request->Groups);
            $Product->Description = $request->Description;
            $Discount = DSP($Product,$request);
            $Product->update();
            return redirect(route('Products'))->with('success','عملیات با موفقیت انجام شد');
        } catch (Exception) {
            return redirect(route('Products'))->with('error','مشکلی به وجود آمده است مجدد تلاش کنید');
        }
    }
    public function Editedetail($id)
    {
        $Product = Products::find($id);
        $Groups = Groups::where('is_Delete','=',0)->get();
        $Titlegroups = Titlegroups::where('is_Delete','=',0)->get();
        $Discount = Discount::find($Product->discounts_id);
        $Suggestion = Suggestion::find($Product->suggestions_id);
        $ProductsTitlegroup = ProductsTitlegroups::where('products_id','=',$Product->id)->get();
        $GroupProducts = GroupsProducts::where('products_id','=',$Product->id)->get();
        return view('Admin.Front.Product.ProductEditedetail',[
            'Product' => $Product,
            'Groups' => $Groups,
            'Titlegroups' => $Titlegroups,
            'Discount' => $Discount,
            'ProductsTitlegroup' => $ProductsTitlegroup,
            'GroupProducts' => $GroupProducts,
            'Suggestion' => $Suggestion
        ]);
    } 
    public function Editeimage($id)
    {
        $Product = Products::find($id);
        return view('Admin.Front.Product.ProductEditeimage',[
            'Product' => $Product
        ]);
    } 

    public function setColorProduct(Request $request)
    {
        if(CSI($request) != false)
        {
            return response()->json(['CPN' => UCSI($request)]);
        }
        else{
            return response()->json(false);
        }       
    }
    public function Editecolor($id)
    {
        $Product = Products::find($id);
        $Colors = Colors::where('is_Delete','=',0)->get();
        $ColorNumberPrice = ColorNumberPrice::where('products_id','=',$Product->id)->get();
        return view('Admin.Front.Product.ProductEditecolor',[
            'Product' => $Product,
            'ColorNumberPrice' => $ColorNumberPrice,
            'Colors' => $Colors,
        ]);
    } 
    public function Editeinfo($id)
    {
        $Product = Products::find($id);
        $Berands = Berands::where('is_Delete','=',0)->get();
        $Categorys = Category::where('is_Delete','=',0)->get();
        return view('Admin.Front.Product.ProductEditeinfo',[
            'Categorys' => $Categorys,
            'Berands' => $Berands,
            'Product' => $Product,
        ]);
    } 

    public function DeleteProduct(Request $request)
    {
        $Product = Products::find($request->id);
        if($Product != null)
        {
            $Product->is_Delete = true;
            $Product->Show = false;
            $Product->update();
        }
        return response()->json($Product);
    } 
    public function deleteimgProduct($id)
    {
        $img = Images::find($id);
        return deleteimgP($img);
         
    } 
    public function setimages(Request $request)
    {
        $path = 'images/Products-image/';
        $TempFiles = TempFile::all();
        $Product = Products::find($request->id);
        $Product->img = moveimgProduct($request,$path,$Product);
        $Product->update();
        insertimgs($request,$TempFiles,$Product);
        return response()->json(['id' => $Product->id , 'images' => getImages($Product)]);
    }

    public function tempupload(Request $request)
    {
        if($request->hasFile('imgs'))
        {
            foreach($request->imgs as $img)
            {
                $image = $img;
                $fileName = time() . $image->getClientOriginalName();
                $folder = uniqid('images-',true);
                $image->storeAs('images/temp/' . $folder,$fileName);
                $tempfile = new TempFile();
                $tempfile->File = $fileName;
                $tempfile->Folder = $folder;
                $tempfile->save();
            }
            return  $folder;
        }
        return '' ;
    }

    public function tempdelete()
    {
        $TempFile = TempFile::where('Folder',request()->getContent())->first();
        Storage::deleteDirectory('images/temp/'.$TempFile->Folder);
        $TempFile->delete();
        return response()->noContent();
    }
    
    public function delimages(Request $request)
    {
        $image = Images::where('id',$request->id)->first();
        return deleteimgP($image);
    }

    public function acceptshowProduct(Request $request)
    {
        $Product = Products::find($request->id);
        $Product->Show = 1;
        $Product->update();
        return redirect(route('Products'));
    }   
}