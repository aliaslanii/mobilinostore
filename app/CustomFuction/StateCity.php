<?php


function getCity($Citys)
{
    $i = 1;
    $ShowCity = '<table class="table text-nowrap text-md-nowrap table-Citys">
    <thead>
    <tr>';
    if(count($Citys) > 0)
    {
        $ShowCity = $ShowCity . '<th>#</th><th>شهر</th><th>عملیات</th>';
    }else{
        $ShowCity = $ShowCity . '<th>شهر</th>';
    }
    $ShowCity = $ShowCity . '</tr></thead><tbody>';
    if(count($Citys) > 0)
    {
        foreach($Citys as $City)
        {
            $ShowCity = $ShowCity .'<tr>
                <th scope="row">'.$i.'</th>
                <td>'.$City->City.'</td>
                <td><a href="javascript:void(0)" data-state="'.$City->states()->id.'" data-id='.$City->id.' class="btn ripple btn-danger ms-2 deletCity"><ion-icon name="trash-outline"></ion-icon></a></td>
            </tr>';
            $i ++;
        }
    }else{
       
        $ShowCity = $ShowCity .'<tr><th>هیچ شهری ثبت نشده است</th></tr> ';
    }
    $ShowCity = $ShowCity .'</tbody></table>';  
    return $ShowCity;        
}