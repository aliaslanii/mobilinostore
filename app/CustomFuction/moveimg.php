<?php

use Illuminate\Support\Facades\File;

// move insert img
function moveimg($request,$path)
{
    if($request->img)
    {
        $extension =$request->img->extension();
        $img = verta()->format('Ymd-hms')."-".random_int(100000, 999999).".".$extension;
        $request->img->move(public_path($path),$img);
        return $img;
    }
    
}

// move insert img Product
function moveimgProduct($request,$path,$Product)
{
    if($request->img)
    {
        $extension =$request->img->extension();
        $img = verta()->format('Ymd-hms')."-".random_int(100000, 999999).".".$extension;
        $request->img->move(public_path($path),$img);
        return $img;
    }else
    {
        return $Product->img;
    }
}

function deleteimgHome($Asset)
{
    if($Asset->image != null)
    {
        File::delete('images/Home-image/'.$Asset->image);
    }
}