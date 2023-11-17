<?php

use App\Models\Asset;

function data_Number()
{
    $Assets = Asset::where('image','=',null)->get();
    $data = '<select id="Number" name="Number" class="form-control select2 required">
    <option selected disabled label="یکی را انتخاب کن"></option>';
    foreach ($Assets as $Asset)
    {
        $data = $data . '<option value="'.$Asset->Number.'">'.$Asset->Name.'</option>';
    }
    return $data = $data  . '</select>';
}

function data_Number_show()
{
    $Assets = Asset::where('image','=',null)->get();
    if(count($Assets) > 0)
    {
        $data = '<select id="Number" name="Number" class="form-control select2 required">
        <option selected disabled label="یکی را انتخاب کن"></option>';
        foreach ($Assets as $Asset)
        {
            $data = $data . '<option value="'.$Asset->Number.'">'.$Asset->Name.'</option>';
        }
        return $data = $data  . '</select>';
    }else{
        return false;
    }
    
}

function data_Number_edit($id)
{
    $Assets = Asset::where('image','!=',null)->get();
    $Asset = Asset::find($id);
    $data = '<select id="Number" name="Number" class="form-control select2 required">';
    foreach ($Assets as $Assett)
    {
        if($Assett->id ==  $Asset->id)
        {
            $data = $data . '<option selected value="'.$Assett->Number.'">'.$Assett->Name.'</option>';
        }
    }
    return $data = $data  . '</select>';
}

function getHomeimg($Number)
{

    $Assets = Asset::where('Number','=',$Number)->first();
    if($Assets)
    {
        return $Assets->image;
    }
}
