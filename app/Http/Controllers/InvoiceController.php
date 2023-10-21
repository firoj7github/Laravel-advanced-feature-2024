<?php

namespace App\Http\Controllers;

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
    
    public function store(Request $request) {
        return $this->storeAll($request, 'product');
    }
}
