<?php

use App\Http\Controllers\AdminAssetController;
use App\Http\Controllers\AdminBasketController;
use App\Http\Controllers\AdminBerandController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminColorController;
use App\Http\Controllers\AdminCommentsController;
use App\Http\Controllers\AdminCotroller;
use App\Http\Controllers\AdminGroupController;
use App\Http\Controllers\AdminMessageController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminStateCityController;
use App\Http\Controllers\AdminTitleGroupController;
use App\Http\Controllers\AuthContriller;
use App\Http\Controllers\HomeAddressController;
use App\Http\Controllers\HomeBasketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeProductController;
use App\Http\Controllers\HomeSearchContriller;
use App\Http\Controllers\HomeUserController;
use App\Http\Controllers\HomeWalletController;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\LoginProviderController;
use App\Http\Controllers\ProductsFaveriteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'Home'])->name('index');
Route::get('/about',[HomeController::class,'about'])->name('about');
Route::get('/ContactUs',[HomeController::class,'ContactUs'])->name('ContactUs');
Route::post('/ContactUs/Send',[HomeController::class,'ContactUsSend'])->name('ContactUsSend');

Route::prefix('Faverit')->middleware('auth')->group(function () {
    Route::post('Add/Favirate',[ProductsFaveriteController::class,'addFavirate'])->name('AddFavirate');
    Route::any('remove/Favirate',[ProductsFaveriteController::class,'removeFavirate'])->name('removeFavirate');
});
Route::prefix('Basket')->middleware('auth')->group(function () {
    Route::any('addproduct',[HomeBasketController::class,'addProduct'])->name('AddProduct');
    Route::any('Pluscount',[HomeBasketController::class,'pluscount'])->name('Pluscount');
    Route::any('Minuscount',[HomeBasketController::class,'minuscount'])->name('Minuscount');
    Route::any('Product/Delete',[HomeBasketController::class,'basketProductDelete'])->name('BasketProductDelete');
    Route::get('Show',[HomeBasketController::class,'basketShow'])->name('BasketShow');
    Route::post('Delete',[HomeBasketController::class,'deleteBasket'])->name('DeleteBasket');
    Route::get('Add/info',[HomeBasketController::class,'addinfo'])->name('Addinfo');
    Route::post('insert/info',[HomeBasketController::class,'insertinfo'])->name('insertinfo');
    Route::get('Payment',[HomeBasketController::class,'basketPayment'])->name('BasketPayment');
    Route::get('Pay/Done/{ordernumber}',[HomeBasketController::class,'basketPayDone'])->name('BasketPayDone');
    Route::get('Send',[HomeBasketController::class,'basketSend'])->name('BasketSend');
    Route::get('Canceled',[HomeBasketController::class,'basketCanceled'])->name('BasketCanceled');
    Route::get('Continued',[HomeBasketController::class,'basketContinued'])->name('BasketContinued');
    Route::get('Cancel/{id}',[HomeBasketController::class,'basketCancel'])->name('BasketCancel');
    Route::get('DargahPardakht/Payment',[HomeBasketController::class,'paymentBasket'])->name('PaymentBasket');
});
Route::prefix('invoice')->middleware('auth')->group(function () {
    Route::get('generate/{id}',[invoiceController::class,'generateinvoice'])->name('Generateinvoice')->middleware('auth');
    Route::get('Download/{id}',[invoiceController::class,'downloadinvoice'])->name('Downloadinvoice')->middleware('auth');
    Route::get('Show/{id}',[invoiceController::class,'generateinvoice'])->name('Generateinvoice')->middleware('auth');
});
Route::prefix("walet")->middleware('auth')->group(function () {
    Route::get('Charge',[HomeWalletController::class,'chargeWallet'])->name('ChargeWallet');
    Route::post('Charge/done',[HomeWalletController::class,'chargewaletdone'])->name('Chargewaletdone')->middleware('auth');
    Route::get('pay/{sumbasket}',[HomeWalletController::class,'paywallet'])->name('Paywallet')->middleware('auth');
});

Route::prefix("Search")->group(function () {
    Route::get('/',[HomeSearchContriller::class,'search'])->name('Search');
    Route::get('Berands/{id}',[HomeSearchContriller::class,'searchBerands'])->name('SearchBerands');
    Route::get('Category/{id}',[HomeSearchContriller::class,'searchCategory'])->name('SearchCategory');
    Route::get('TitleGroup/{id}',[HomeSearchContriller::class,'searchTitleGroup'])->name('SearchTitleGroup');
    Route::get('Groups/{id}',[HomeSearchContriller::class,'searchGroups'])->name('SearchGroups');
});

Route::prefix("Profile")->middleware('auth')->group(function () {
    Route::get('/',[HomeUserController::class,'Profile'])->name('Profile')->middleware('auth');
    Route::get('Faverit/Products',[HomeUserController::class,'faveritProducts'])->name('FaveritProducts')->middleware('auth');
    Route::get('Update/password',[HomeUserController::class,'updatepassword'])->name('Updatepassword')->middleware('auth');
    Route::post('insert/password',[HomeUserController::class,'insertpassword'])->name('insertpassword')->middleware('auth');
    Route::get('edit',[HomeUserController::class,'editProfile'])->name('editProfile')->middleware('auth');
    Route::post('insert',[HomeUserController::class,'insertProfile'])->name('insertProfile')->middleware('auth');
});

Route::prefix("Product")->group(function () {
    Route::get('/{P_id}/{Name}/{Color}',[HomeProductController::class,'showProduct'])->name('ShowProduct');
    Route::post('Add/Point/plus',[HomeProductController::class,'AddPointplus'])->name('AddPointplus');
    Route::post('Add/Point/minus',[HomeProductController::class,'AddPointminus'])->name('AddPointminus');
    Route::post('insert/Comment/Product',[HomeProductController::class,'insertCommentProduct'])->name('insertCommentProduct');
    Route::post('SelectColor',[HomeProductController::class,'SelectColor'])->name('SelectColor');
});

Route::prefix("Address")->middleware('auth')->group(function () {
    Route::get('/',[HomeAddressController::class,'Address'])->name('Address');
    Route::post('New',[HomeAddressController::class,'newAddress'])->name('NewAddress');
    Route::post('insert',[HomeAddressController::class,'insertAddress'])->name('insertAddress');
    Route::post('edit',[HomeAddressController::class,'editAddress'])->name('editAddress');
    Route::post('Update',[HomeAddressController::class,'updatetAddress'])->name('UpdatetAddress');
    Route::post('Delete',[HomeAddressController::class,'deleteAddress'])->name('DeleteAddress');
    Route::post('Select/State',[HomeAddressController::class,'selectStates'])->name('SelectStates');
    Route::post('Select',[HomeAddressController::class,'selectAddress'])->name('SelectAddress');
});

/*
|--------------------------------------------------------------------------
|Auth
|--------------------------------------------------------------------------
*/
Route::get('/auth/{Provider}/redirect',[LoginProviderController::class,'redirect'])->name('redirect');
Route::any('/auth/{Provider}/callback',[LoginProviderController::class,'callback'])->name('callback');
Route::any('/auth/Rigester',[LoginProviderController::class,'rigesterGoogle'])->name('rigesterGoogle');
Route::get('/logout',[AuthContriller::class,'logout'])->name('logout');
Auth::routes();
/*
|--------------------------------------------------------------------------
|Admin Panel
|--------------------------------------------------------------------------
*/
Route::prefix("admin")->middleware(['admin.role','auth'])->group(function () {

    Route::get("/", [AdminCotroller::class, "index"])->name('Admin');

    Route::prefix("Profile")->group(function () {
        Route::get('/',[AdminCotroller::class,'adminProfile'])->name('AdminProfile');
        Route::post('Update',[AdminCotroller::class,'adminProfileUpdate'])->name('AdminProfileUpdate');
        Route::post('Update/img',[AdminCotroller::class,'adminProfileUpdateimg'])->name('AdminProfileUpdateimg');
    });

    Route::prefix("Categorys")->group(function () {
        Route::get('/',[AdminCategoryController::class,'Categorys'])->name('Categorys');
        Route::post('insert',[AdminCategoryController::class,'insertCategory'])->name('insertCategory');
        Route::post('Edite',[AdminCategoryController::class,'EditeCategory'])->name('EditeCategory');
        Route::post('Update',[AdminCategoryController::class,'UpdateCategory'])->name('UpdateCategory');
        Route::post('Delete',[AdminCategoryController::class,'DeleteCategory'])->name('DeleteCategory');
        Route::prefix("TitleGroups")->group(function () {
            Route::get('/',[AdminTitleGroupController::class,'TitleGroups'])->name('TitleGroups');
            Route::post('Create',[AdminTitleGroupController::class,'TitleGroupCreate'])->name('TitleGroupCreate');
            Route::post('insert',[AdminTitleGroupController::class,'insertTitleGroup'])->name('insertTitleGroup');
            Route::post('Edite',[AdminTitleGroupController::class,'EditeTitleGroup'])->name('EditeTitleGroup');
            Route::post('Update',[AdminTitleGroupController::class,'UpdateTitleGroup'])->name('UpdateTitleGroup');
            Route::post('Delete',[AdminTitleGroupController::class,'DeleteTitleGroup'])->name('DeleteTitleGroup');
        });
        Route::prefix("Groups")->group(function () {
            Route::get('/',[AdminGroupController::class,'Groups'])->name('Groups');
            Route::post('Create',[AdminGroupController::class,'CreateGroup'])->name('CreateGroup');
            Route::post('insert',[AdminGroupController::class,'insertGroup'])->name('insertGroup');
            Route::post('Edite',[AdminGroupController::class,'EditeGroup'])->name('EditeGroup');
            Route::post('Update',[AdminGroupController::class,'UpdateGroup'])->name('UpdateGroup');
            Route::post('Delete',[AdminGroupController::class,'DeleteGroup'])->name('DeleteGroup');
        });
    });
    Route::prefix("Berands")->group(function () {
        Route::get('/',[AdminBerandController::class,'Berands'])->name('Berands');
        Route::post('getCategorys',[AdminBerandController::class,'getBerandCategorys'])->name('getBerandCategorys');
        Route::post('Categorys',[AdminBerandController::class,'BerandCategorys'])->name('BerandCategorys');
        Route::post('insert',[AdminBerandController::class,'insertBerand'])->name('insertBerand');
        Route::post('Edite',[AdminBerandController::class,'EditeBerand'])->name('EditeBerand');
        Route::post('Update',[AdminBerandController::class,'UpdateBerand'])->name('UpdateBerand');
        Route::post('Delete',[AdminBerandController::class,'DeleteBerand'])->name('DeleteBerand');
    });

    Route::prefix("Colors")->group(function () {
        Route::get('/',[AdminColorController::class,'Colors'])->name('Colors');
        Route::post('insert',[AdminColorController::class,'insertColor'])->name('insertColor');
        Route::post('Edite',[AdminColorController::class,'EditeColor'])->name('EditeColor');
        Route::post('Update',[AdminColorController::class,'UpdateColor'])->name('UpdateColor');
        Route::post('Delete',[AdminColorController::class,'DeleteColor'])->name('DeleteColor');
    });

    Route::prefix("Product")->group(function () {
        Route::get('/',[AdminProductController::class,'Products'])->name('Products');
        Route::post('details',[AdminProductController::class,'detailsProduct'])->name('detailsProduct');
        Route::get('Create',[AdminProductController::class,'CreateProduct'])->name('CreateProduct');
        Route::get('Defective',[AdminProductController::class,'defectiveProducts'])->name('DefectiveProducts');
        Route::post('insert',[AdminProductController::class,'insertProduct'])->name('insertProduct');
        Route::post('Set/CPN',[AdminProductController::class,'setCPN'])->name('SetCPN');
        Route::post('Edit/CPN',[AdminProductController::class,'editCPN'])->name('EditCPN');
        Route::post('Set/DSP',[AdminProductController::class,'setDSP'])->name('SetDSP');
        Route::post('Set/images',[AdminProductController::class,'setimages'])->name('Setimages');
        Route::post('Delete/images',[AdminProductController::class,'delimages'])->name('Delimages');
        Route::post('accept/show',[AdminProductController::class,'acceptshowProduct'])->name('acceptshowProduct');
        Route::get('Edite/info/{id}',[AdminProductController::class,'Editeinfo'])->name('Editeinfo');
        Route::get('Edite/Color/{id}',[AdminProductController::class,'Editecolor'])->name('EditeColor');
        Route::post('Set/Color',[AdminProductController::class,'setColorProduct'])->name('SetColorProduct');
        Route::get('Edite/image/{id}',[AdminProductController::class,'Editeimage'])->name('Editeimage');
        Route::get('Edite/detail/{id}',[AdminProductController::class,'Editedetail'])->name('EditeDetail');
        Route::get('deleteimg/{id}',[AdminProductController::class,'deleteimgProduct'])->name('deleteimgProducts');
        Route::post('Update',[AdminProductController::class,'UpdateProduct'])->name('UpdateProduct');
        Route::post('Delete',[AdminProductController::class,'DeleteProduct'])->name('DeleteProduct');
    });

    Route::prefix("messages")->group(function () {
        Route::get('/',[AdminMessageController::class,'messages'])->name('messages');
        Route::post('delete',[AdminMessageController::class,'deleteMessages'])->name('deleteMessages');
    });

    Route::prefix("Baskets")->group(function () {
        Route::get('/',[AdminBasketController::class,'baskets'])->name('Baskets');
        Route::get('cancel',[AdminBasketController::class,'basketsCancel'])->name('Basketscancel');
        Route::get('paydone',[AdminBasketController::class,'basketsPaydone'])->name('Basketspaydone');
        Route::get('send',[AdminBasketController::class,'basketsSend'])->name('Basketssend');
        Route::post('Exit',[AdminBasketController::class,'ExitBasket'])->name('ExitBasket');
        Route::post('Cancel',[AdminBasketController::class,'cancelBasket'])->name('Basketcancel');
        Route::post('Show',[AdminBasketController::class,'basketsShow'])->name('BasketsShow');
        Route::get('Delete/{id}',[AdminBasketController::class,'basketsDelete'])->name('BasketsDelete');
    });

    Route::prefix("Commnets")->group(function () {
        Route::get('/',[AdminCommentsController::class,'commnets'])->name('Commnets');
        Route::post('Show',[AdminCommentsController::class,'commnetsShow'])->name('CommnetsShow');
        Route::post('Accept',[AdminCommentsController::class,'commnetAccept'])->name('CommnetAccept');
        Route::post('Delete',[AdminCommentsController::class,'commnetDelete'])->name('CommnetDelete');
    });

    Route::prefix("Assets/image")->group(function () {
        Route::get('/',[AdminAssetController::class,'index'])->name('Assets');
        Route::post('Add',[AdminAssetController::class,'store'])->name('Addimage');
        Route::post('show',[AdminAssetController::class,'show'])->name('Showimage');
        Route::post('Edite',[AdminAssetController::class,'edit'])->name('Editimage');
        Route::post('Update',[AdminAssetController::class,'update'])->name('Updateimage');
    });

    Route::get('StateCity',[AdminStateCityController::class,'stateCity'])->name('StateCity');
    Route::post('Show/City',[AdminStateCityController::class,'showCity'])->name('ShowCity');
    Route::post('Select/State',[AdminStateCityController::class,'selectState'])->name('SelectState');
    Route::post('insert/City',[AdminStateCityController::class,'insertCity'])->name('insertCity');
    Route::post('insert/State',[AdminStateCityController::class,'insertState'])->name('insertState');
    Route::post('Delete/City',[AdminStateCityController::class,'deleteCity'])->name('DeleteCity');
    Route::post('Delete/State',[AdminStateCityController::class,'deleteState'])->name('DeleteState');
});
/*
|--------------------------------------------------------------------------
|temp
|--------------------------------------------------------------------------
*/
Route::post('/temp/upload/Product/img',[AdminProductController::class,'tempupload']);
Route::delete('/temp/delete/Product/img',[AdminProductController::class,'tempdelete']);