<?php

use App\Models\invoice;
use App\Models\invoiceProducts;

function createinvoice($Basket,$Sum)
{
    $invoice = new invoice();
    $invoice->baskets_id = $Basket->id;
    $invoice->SumPrice = $Sum;
    $invoice->invoicnumber = 'MIN-200001727'.random_int(100000,9999999);
    $invoice->save();
    foreach($Basket->BasketsProducts() as $BasketsProducts)
    {
        $invoiceProducts = new invoiceProducts();
        $invoiceProducts->invoice_id = $invoice->id;
        $invoiceProducts->products_id = $BasketsProducts->Products()->id;
        $invoiceProducts->color_id = $BasketsProducts->Color()->id;
        $invoiceProducts->Number = $BasketsProducts->count;
        $invoiceProducts->Price = Price($BasketsProducts->Products()->id,$BasketsProducts->Color()->id);
        if($BasketsProducts->Products()->Discounts())
        {
            $invoiceProducts->Discount = 1;
            $invoiceProducts->Discount_number = $BasketsProducts->Products()->Discounts()->Discount_number;
        }
        $invoiceProducts->save();
    }
    
}

function Basketinvoice($Basket)
{
    return $invoice = invoice::where('baskets_id','=',$Basket->id)
    ->first();
    
}