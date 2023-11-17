<?php

use App\Models\Category;
use App\Models\Titlegroup;
use App\Models\Titlegroups;
use Illuminate\Support\Facades\File;

function CeckCategoryshow()
{
    $Categorys = Category::where('is_Delete','=','0')
    ->where('showhome','=','1')
    ->get();
    if(count($Categorys) < 12)
    {
       return true;
    }
    return false;
}

function CeckCategoryUpdate($Category)
{
    if(CeckCategoryshow() == false && $Category->showhome == 0)
    {
        return true;
    }
    return false;
}
function dmiimgCategory($request,$Category)
{
    if($request->img)
    {
        $extension =$request->img->extension();
        $img = verta()->format('Ymd-hms')."-".random_int(100000, 999999).".".$extension;
        $request->img->move(public_path('images/Category-image'),$img);
        File::delete('images/Category-image/'.$Category->img);
        return $img;
    }
    else
    {
        return $Category->img;
    }
}
// found Category titleGroup
function FCT($TitleGroup)
{
    $Categorys = Category::where('is_Delete','=',0)->get();
    $Categoryid = $TitleGroup->category()->id;
    $data = '<select id="TitleGroupCategorys" class="form-control select select2" name="Category">';
    foreach ($Categorys as $Category)
    {
        if($Categoryid == $Category->id)
        {
             $data = $data . '<option selected class="option-TitleGroup" value="'.$Category->id.'">'.$Category->Name.'</option>';
        }
        else{
            $data = $data .'<option class="option-TitleGroup" value="'.$Category->id.'">'.$Category->Name.'</option>';
        }
    }
    $data = $data .'</select>';
    return $data;
}
// Category titleGroup
function CT()
{
    $Categorys = Category::where('is_Delete','=',0)->get();
    if(count($Categorys) != 0)
    {
        $data = '<select id="TitleGroupCategorys" class="form-control select select2" name="Category"><option disabled selected class="option-TitleGroup">انتخاب کنید</option>';
        foreach ($Categorys as $Category)
        {
            $data = $data .'<option class="option-TitleGroup" value="'.$Category->id.'">'.$Category->Name.'</option>';
        }
        $data = $data .'</select>'; 
    }else{
        $data = 0 ;
    }
    return $data;
}

// found titleGroup title
function FTT($Group)
{
    $Titlegroups = Titlegroups::where('is_Delete','=',0)->get();
    $Titlegroupid = $Group->Titlegroups()->id;
    $data = '<select id="Grouptite" class="form-control select select2" name="titlegroup">';
    foreach ($Titlegroups as $Titlegroup)
    {
        if($Titlegroupid == $Titlegroup->id)
        {
             $data = $data . '<option selected class="option-Group" value="'.$Titlegroup->id.'">'.$Titlegroup->title.'</option>';
        }
        else{
            $data = $data .'<option class="option-Group" value="'.$Titlegroup->id.'">'.$Titlegroup->title.'</option>';
        }
    }
    $data = $data .'</select>';
    return $data;
}
// titleGroup title
function TT()
{
    $Titlegroups = Titlegroups::where('is_Delete','=',0)->get();
    if(count($Titlegroups) != 0)
    {
        $data = '<select id="Grouptite" class="form-control select select2" name="titlegroup"><option selected disabled class="option-Group">انتخاب کنید</option>';
        foreach ($Titlegroups as $Titlegroup)
        {
            $data = $data .'<option class="option-Group" value="'.$Titlegroup->id.'">'.$Titlegroup->title.'</option>';
        }
        $data = $data .'</select>'; 
    }else{
        $data = 0 ;
    }
    return $data;
}
function getImgCategory($img)
{
    return '<img class="img-thumbnail img-Berand-update" src="'.asset('images/Category-image/'.$img).'" id="img-old">';
}