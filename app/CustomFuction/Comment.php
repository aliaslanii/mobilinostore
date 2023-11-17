<?php

use App\Models\Comments_minus;
use App\Models\Comments_plus;

function addPointplus($point)
{
    $data = '<a class="text-plus delete-point"><ion-icon class="icon-trash" 
   name="trash-outline"></ion-icon>'.$point.'</a><br>';
    return $data;
}

function addPointminus($point)
{
   $data = '<a class="text-minus delete-point"><ion-icon class="icon-trash" 
   name="trash-outline"></ion-icon>'.$point.'</a><br>';
    return $data;
}

function pointPlus($Comments)
{
    return $Plus = Comments_plus::where('comments_id','=',$Comments->id)
    ->get();
}

function pointMinus($Comments)
{
    return $Minus = Comments_minus::where('comments_id','=',$Comments->id)
    ->get();
}

function getComment($Comment,$Plus,$Minus)
{
    $data = '<div class="Comment-detal"><h6 class="title mb-4"><b>متن کامنت :</b> '.$Comment->Description.'</h6>
    <table class="table text-nowrap text-md-nowrap mg-b-0">
        <thead>
        <tr>
        <th>نکات مثبت </th>
        </tr>
        </thead>
        <tbody>';
    foreach($Plus as $value)
    {
        $data = $data . '<tr>
            <td>'.$value->plus.'</td>
        </tr>';
    }
    $data = $data . '</tbody>
    </table>
    <table class="table text-nowrap text-md-nowrap mg-b-0">
        <thead>
        <tr>
        <th>نکات منفی</th>
        </tr>
        </thead>
        <tbody>';
        foreach($Minus as $Minu)
        {
            $data = $data . '<tr>
                <td>'.$Minu->minus.'</td>
            </tr>';
        }
        $data = $data . '</tbody></table></div>';
    return $data;
}

