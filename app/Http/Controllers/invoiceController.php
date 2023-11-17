<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class invoiceController extends Controller
{
    public function generateinvoice($id)
    {
        $invoice = invoice::findOrFail($id);
        return view('Home.invoice.Generate-invoice',[
            'invoice' => $invoice
        ]);
    }
    public function downloadinvoice($id)
    {
        $invoice = invoice::findOrFail($id);
        $data = ['invoice' => $invoice];
        $pdf = Pdf::loadView('Home.Front.invoice.Generate-invoice', $data);
        return $pdf->download('invoice'.$invoice->invoicnumber.'-'.verta($invoice->created_at)->format('Y-m-d').'.pdf');

    } 
}
