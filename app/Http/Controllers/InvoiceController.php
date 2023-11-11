<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Session;
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
            $html .= '<form id="invoice_form_submit" action= "' .route('show.invoice') . '" method="post" id="invoice_form_submit">'; 
            $html .= csrf_field();
            $html .='<table class="table table-striped">';
            $html .= '<tbody>';

            foreach($invoices as $invoice){
               
               
                $html .= '<tr>';

                if ($invoice->product_id) {
                  $html .= '<td style="padding: 4px">' .$invoice->product->name . '</td>';
                  $html .= '<td style="padding: 0px"><input type="hidden" name="product_ids[]" value="' . $invoice->product_id . '"></td>';
                  $html .='<td style="padding: 4px" ><a href="#" class="deletwCart" data-id= "' .$invoice->product_id . '"><i class="fa fa-trash btn btn-sm btn-danger"></i></a></td>';
                }

                if($invoice->banner_id){
                    $html .= '<td style="padding: 4px">' . $invoice->banner->name .  '</td>';
                    $html .= '<td style="padding: 0px"><input type="hidden" name="banner_ids[]" value="' . $invoice->banner_id . '"></td>';
                    $html .= '<td style="padding: 4px"><a class="deletwCart" data-id="' .$invoice->product_id . '"><i class="fa fa-trash btn btn-sm btn-danger"></i></a></td>';
                }


            $html .='</tr>';
            }
            
            $html .= '</tbody>';


            $html .='</table>';

            $html .= '<button type="submit" class="btn btn-info checkInvoiceNull" style="float: right; margin-top: 20px;">Invioce Ready</button>';
            $html .= '<button type="submit" class="btn btn-danger clearAllBtn" style="float: left; margin-top: 20px;">Clear All</button>';
           
            
    
            $html .= '</form>';
        }
        return response()->json(['status' => 'success', 'data' => $html, 'count'=>count($invoices)]);
    
      
    }

    public function invioce(Request $request){

        // return $request->all(); 
        $productIds = $request->input('product_ids',[]);
        $bannerIds = $request->input('banner_ids',[]);
         Session::put('invoice_data',[
            'product_ids'=>$productIds,
            'banner_ids'=>$bannerIds,
         ]);

         return view('invoice.show_invoice');


    }
}
