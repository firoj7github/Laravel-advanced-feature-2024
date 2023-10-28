<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index(){
        
        $products= Product::get();
        return view ('invoice.invoice', compact('products'));
    }
    public function show(){
        
        $banners= Banner::get();
        return view ('banner.banner', compact('banners'));
    }

    public function storeAll(Request $request, $type) {
        try {
            $selectData = $request->ListingSelectData;
            $package = $request->packagePlan;
    
            $existingInvoice = Invoice::whereIn("{$type}_id", $selectData)->get();
    
            $price = $this->getPriceBasedOnType($type);
            
            if ($existingInvoice->isEmpty()) {
                $this->insertInvoiceStore($selectData, $type, $package, $price);
            }
            
            return response()->json(['status' => 'success']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    private function getPriceBasedOnType($type) {
        switch ($type) {
            case 'product':
                return '500';
            case 'banner':
                return '700';
            default:
                return '100';
        }
    }
    
    private function insertInvoiceStore($ids, $type, $package, $price) {
        $column = "{$type}_id";
        $invoicesToInsert = [];
        
        foreach ($ids as $id) {
            $invoicesToInsert[] = [
                $column => $id,
                'package' => $package,
                'price' => $price,
                'user_id' => Auth::id(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        Invoice::insert($invoicesToInsert);
    }
    
    public function invoiceStore(Request $request) {
        return $this->storeAll($request, 'product');
    }
    public function bannerStore(Request $request) {
        return $this->storeAll($request, 'banner');
    }


    public function getCartItem(){
        $invoices = Invoice::where('status', 0)->get();
       
        $html = '';
    
        if ($invoices->count() > 0) { 
            $html .= '<form id="invoice_form_submit">'; 
            $html .= csrf_field();
            $html .='<table class="table">';
            $html .= '<tbody>';

            foreach($invoices as $invoice){
               
               
                $html .= '<tr>';

                if ($invoice->product_id) {
                  $html .= '<td style="padding: 0px">' .$invoice->price. '</td>';
                }


            $html .='</tr>';
            }
            
            $html .= '</tbody>';


            $html .='</table>';
           
            
    
            $html .= '</form>';
        }
        return response()->json(['status' => 'success', 'data' => $html]);
    
      
    }
}
