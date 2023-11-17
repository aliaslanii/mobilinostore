<?php

use App\Models\Addres;
use Illuminate\Support\Facades\Auth;

function AddressUser($Address)
{
    $data = '<div class="checkout-contact Address-user">
        <div class="checkout-contact-content">
            <ul class="checkout-contact-items" style="display:inline-block;">
                <li class="checkout-contact-item checkout-contact-item-username"> گیرنده : 
                    <span class="js-recipient-full-name">'.$Address->Name.'</span>
                    <a href="javascript:void(0)" class="checkout-contact-edit editAddress" data-id="'.$Address->id.'" data-toggle="modal" data-target="#AddressModal">اصلاح این آدرس</a>
                </li>
                <li class="checkout-contact-item checkout-contact-item-location">
                <div class="checkout-contact-item checkout-contact-item-mobile">
                    شماره تماس : 
                    <span class="js-recipient-mobile-phone">'.$Address->Mobile.'</span>
                </div>
                <div class="checkout-contact-item-message">
                    کد پستی :
                    <span class="js-recipient-post_code">'.$Address->ZipCode.'</span>
                </div>
                <br>
                <span class="js-recipient-address-part">'.$Address->Address.'</span>
                </li>
                <input hidden name="Addres_id" value="'.$Address->id.'">
            </ul>
            <button class="checkout-contact-location" type="button" data-toggle="modal" data-target="#SelectAddress">تغییر آدرس ارسال</button>
        </div>
    </div>';
    return $data;
}


function AddresSelect($Address)
{
    $data = '';
    foreach ($Address as $Addres)
    {
        $data = $data . '<div class="middle-container-Address"><div class="checkout-contact-content">
            <ul class="checkout-contact-items" style="display:inline-block;">
                <li class="checkout-contact-item checkout-contact-item-username"> گیرنده : 
                    <span class="js-recipient-full-name">'.$Addres->Name.'</span>
                </li>
                <li class="checkout-contact-item checkout-contact-item-location">
                <div class="checkout-contact-item checkout-contact-item-mobile">
                    شماره تماس : 
                    <span class="js-recipient-mobile-phone">'.$Addres->Mobile.'</span>
                </div>
                <div class="checkout-contact-item-message">
                    کد پستی :
                    <span class="js-recipient-post_code">'.$Addres->ZipCode.'</span>
                </div>
                <br>
                <span class="js-recipient-address-part">'.$Addres->Address.'</span>
                </li>
            </ul>
            <a href="javascript:void(0)" data-id="'.$Addres->id.'" class="checkout-contact-edit float-left SelectAddress">انتخاب آدرس</a>
        </div>
        <hr>';
    }
    $data = $data . '<a href="javascript:void(0)" data-id="'.$Addres->id.'" class="checkout-contact-edit float-left newAddress">ایجاد آدرس ارسال</a></div>';
    return $data;
}


function generateCitySelect($Citys)
{
    $data = '<div class="Select-City">
        <label for="city">شهر 
        <span class="required-star" style="color:red;">*</span></label>
        <select name="City" id="city" class="form-control">
            <option value="date-desc" selected="selected">شهر مورد نظر خود را انتخاب کنید</option>';
        foreach($Citys as $City)
        {
            $data = $data . '<option value="'.$City->id.'" class="Select-State">'.$City->City.'</option>';
        }
    $data = $data .'</select></div>';
    return $data;
}

function AddressForm($Address,$States,$Citys)
{
    $data = '<form id="AddressForm" method="POST" class="form-checkout">
    <div class="form-checkout-row">
        <label for="name">نام تحویل گیرنده <span class="required-star" style="color:red;">*</span></label>
        <input type="text" name="Name" required id="name" class="input-name-checkout form-control" value="'.$Address->Name.'" placeholder="نام تحویل گیرنده را وارد نمایید">
        <label for="phone-number">شماره موبایل <span class="required-star" style="color:red;">*</span></label>
        <input type="text" name="Mobile" required id="phone-number" class="input-name-checkout form-control" value="'.$Address->Mobile.'"  placeholder="09xxxxxxxxx" style="text-align:left;">
        <label for="fixed-number">شماره تلفن ثابت <span class="required-star" style="color:red;">*</span></label>
        <input type="text" name="Phone" id="fixed-number" class="input-name-checkout form-control" value="'.$Address->Phone.'"  placeholder="021xxxxxx" style="text-align:left;">
        <div class="form-checkout-valid-row">
        <label for="city">استان 
        <span class="required-star" style="color:red;">*</span></label>
        <select name="State" class="form-control State">
        <option value="date-desc" selected="selected">استان مورد نظر خود را انتخاب کنید </option>';
            foreach ($States as $State)
            {
                if($State->id == $Address->states()->id)
                {
                    $data = $data . '<option value="'.$State->id.'" selected class="Select-State">'.$State->State.'</option>';
                }else{
                    $data = $data . '<option value="'.$State->id.'" class="Select-State">'.$State->State.'</option>';
                }   
            }
            $data =  $data .'</select>
            <label for="bld-num">پلاک<span class="required-star" style="color:red;">*</span></label>
            <input type="text" name="Plate" id="bld-num" class="input-name-checkout js-input-bld-num form-control" value="'.$Address->Plate.'" placeholder="پلاک را وارد نمایید">
        </div>
        <div class="form-checkout-valid-row">
            <div class="Citys">
                <div class="Select-City">
                <label for="city">شهر 
                <span class="required-star" style="color:red;">*</span></label>
                <select name="City" id="city" class="form-control">
                    <option value="date-desc" selected="selected">شهر مورد نظر خود را انتخاب کنید</option>';
                    foreach($Citys as $City)
                    {
                        if($City->id == $Address->cities()->id)
                        {
                            $data = $data . '<option value="'.$City->id.'" selected class="Select-State">'.$City->City.'</option>';
                        }else{
                            $data = $data . '<option value="'.$City->id.'" class="Select-State">'.$City->City.'</option>';
                        } 
                    }       
            $data = $data .  '</select></div>
            </div>
            <label for="apt-id">واحد</label>
            <input type="text" name="Unit" id="apt-id" class="input-name-checkout js-input-apt-id form-control" value="'.$Address->Unit.'" placeholder="واحد را وارد نمایید">
        </div>
        
        <label for="post-code">کد پستی<span class="required-star" style="color:red;">*</span></label>
        <input type="text" name="ZipCode" id="post-code" class="input-name-checkout form-control" value="'.$Address->ZipCode.'" placeholder="کد پستی را بدون خط تیره بنویسید">
        
        <label for="address">آدرس 
        <span class="required-star" style="color:red;">*</span></label>
        <input type="text" name="Address" id="address" class="input-name-checkout form-control" value="'.$Address->Address.'" placeholder="آدرس خود را وارد نمایید" style="height:80px;">
        <input type="hidden" name="id" value="'.$Address->id.'">
        <div class="AR-CR">
        <center>
            <button type="button" value="update"  class="btn-registrar saveAddress"> ویرایش آدرس</button>
        </center>
        </div>
    </div>
    </form>';
    return $data;
}


function AddressFormnew($States)
{
    $data = ' <form id="AddressForm" method="POST" class="form-checkout">
    <div class="form-checkout-row">
        <label for="name">نام تحویل گیرنده <span class="required-star" style="color:red;">*</span></label>
        <input type="text" name="Name" required id="name" class="input-name-checkout form-control" placeholder="نام تحویل گیرنده را وارد نمایید">
        <label for="phone-number">شماره موبایل <span class="required-star" style="color:red;">*</span></label>
        <input type="text" name="Mobile" required id="phone-number" class="input-name-checkout form-control" placeholder="09xxxxxxxxx" style="text-align:left;">
        <label for="fixed-number">شماره تلفن ثابت <span class="required-star" style="color:red;">*</span></label>
        <input type="text" name="Phone" id="fixed-number" class="input-name-checkout form-control" placeholder="021xxxxxx" style="text-align:left;">
        
        <div class="form-checkout-valid-row">
              <label for="city">استان 
              <span class="required-star" style="color:red;">*</span></label>
            <select name="State" class="form-control State">
                <option value="date-desc" selected="selected">استان مورد نظر خود را انتخاب کنید </option>';
                  foreach ($States as $State)
                  {
                    $data =$data . '<option value="'.$State->id .'" class="Select-State">'.$State->State.'</option>';
                  }
            $data =$data . '</select>
            <label for="bld-num">پلاک<span class="required-star" style="color:red;">*</span></label>
            <input type="text" name="Plate" id="bld-num" class="input-name-checkout js-input-bld-num form-control" placeholder="پلاک را وارد نمایید">
        </div>
        <div class="form-checkout-valid-row">
              <div class="Citys">
                  <div class="Select-City">
                      <label for="city">شهر 
                      <span class="required-star" style="color:red;">*</span></label>
                      <select name="City" id="city" class="form-control">
                          <option value="date-desc" selected="selected">شهر مورد نظر خود را انتخاب کنید</option>
                      </select>
                  </div>
              </div>
            <label for="apt-id">واحد</label>
            <input type="text" name="Unit" id="apt-id" class="input-name-checkout js-input-apt-id form-control" placeholder="واحد را وارد نمایید">
        </div>
        
        <label for="post-code">کد پستی<span class="required-star" style="color:red;">*</span></label>
        <input type="text" name="ZipCode" id="post-code" class="input-name-checkout form-control" placeholder="کد پستی را بدون خط تیره بنویسید">
        
        <label for="address">آدرس 
        <span class="required-star" style="color:red;">*</span></label>
        <input type="text" name="Address" id="address" class="input-name-checkout form-control" placeholder="آدرس خود را وارد نمایید" style="height:80px;">
        
        <div class="AR-CR">
          <center>
              <button type="button" value="create" class="btn-registrar saveAddress"> ثبت آدرس</button>
          </center>
        </div>
    </div>
</form>';
    return $data;
}

function HomeAddress($Address)
{
    $data = '<div id="address-section">';
    foreach ($Address as $Addres)
    {
        $data = $data . ' <div class="profile-address-container user-address-container">
            <div class="profile-address-card">
                <div class="profile-address-card-desc">
                    <h4 class="js-address-full-name">'.$Addres->Name.'</h4>
                    <p class="checkout-address-text">
                        <span class="js-address-address-part">
                            '.$Addres->states()->State.' , '. $Addres->cities()->City.' , '.$Addres->Address.'
                        </span>
                    </p>
                </div>
                <div class="profile-address-card-data address-profile">
                    <ul class="profile-address-card-methods">
                        <li class="profile-address-card-method">
                            <i class="fa fa-envelope-o"></i>
                            کدپستی : 
                            <span class="js-address-post-code">
                                '.$Addres->ZipCode.'
                            </span>
                        </li>
                        <li class="profile-address-card-method">
                            <i class="fa fa-mobile"></i>
                            تلفن همراه :  
                            <span class="js-address-post-code">
                                '.$Addres->Mobile.'
                            </span>
                        </li>
                    </ul>
                    <div class="profile-address-card-actions">
                    <button class="btn-note js-remove-address-btn removeaddress"data-id="'.$Addres->id.'">حذف</button>
                        <button class="btn-note js-edit-address-btn editAddress" data-id="'.$Addres->id.'">ویرایش</button>
                    </div>
                </div>
            </div>
        </div>';
    }
    $data = $data . '</div>';
    return $data;
}