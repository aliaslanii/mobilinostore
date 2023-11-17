<?php
use App\Models\Category;
use Illuminate\Support\Facades\File;
function dmiimgBerand($request,$path,$Berands)
{
    if($request->img)
    {
        $extension =$request->img->extension();
        $img = verta()->format('Ymd-hms')."-".random_int(100000, 999999).".".$extension;
        $request->img->move(public_path($path),$img);
        File::delete('images/Berands-image/'.$Berands->img);
        return $img;
    }
    else
    {
        return $Berands->img;
    }
}

// Category berand found
function CBF($Berand)
{
    $berandsCategory = '<ul class="list-group">';
    foreach($Berand->Categorys as $Category)
    {   
        $berandsCategory =  $berandsCategory . '<li class="borderr liCategory">'.$Category->Name.'</li>';
    }
    if(count($Berand->Categorys) == 0)
    {
        $berandsCategory = '<li class="borderr liCategory">ثبت نشده است</li>';
    }
    $berandsCategory =  $berandsCategory . '</ul>';
    return $berandsCategory;
}


// Category berand Check
function CBC($Berand)
{
    $Categorys = Category::where('is_Delete','=',0)->get();
    $data = '';
    foreach ($Categorys as $Category)
    {
        $berandsCategory = '';
        $berandsCategory = $berandsCategory . '<div class="col-lg-12 mb-2 form-check-berand">
        <label class="ckbox" for="'.$Category->id.'"><input name="Categorys[]" multiple id="'.$Category->id.'" type="checkbox"';
        foreach ($Berand->Categorys as $BerandCategory)
        {
            if ($BerandCategory->id ==  $Category->id)
            {
                $berandsCategory = $berandsCategory . 'checked ';
            }
        }
        $berandsCategory = $berandsCategory .'value="'.$Category->id.'">
        <span>'.$Category->Name.'</span></label></div>';
        $data = $data . $berandsCategory;
    }
    return $data;
}

// Get Category berand 
function GCB()
{
    $Categorys = Category::where('is_Delete','=',0)->get();
    $berandsCategory = '';
    foreach ($Categorys as $Category)
    {
        $berandsCategory =  $berandsCategory . '<div class="col-lg-12 mb-2 form-check-berand">
            
            <label class="ckbox" for="'.$Category->id.'"><input name="Categorys[]" multiple id="'.$Category->id.'" type="checkbox" value="'.$Category->id.'"><span>'.$Category->Name.'</span></label></div>';
    }
    return $berandsCategory;
}
function getImgBerand($img)
{
    return '<img class="img-thumbnail img-Berand-update" src="'.asset('images/Berands-image/'.$img).'" id="img-old">';
}