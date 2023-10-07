<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function addlead(Request $request){

        if($request->ajax())
        {
  
            $lead = new Lead();
            $customer = new Customer();
            if($request->customer_id == null)
            {
                $validator = Validator::make($request->all(),[

                    'cus_name' => 'required|string',
                    
                    'email' => 'required|email',
                    
                ]);
                if($validator->fails())
                {
                    return response()->json(['error'=>$validator->errors()]);
                }

                
               
                $customer->cus_name = $request->cus_name;
                $customer->email = $request->email;
                
                $customer->save();
                $lead->customer_id =$customer->id;

            }
            else
            {
                $validator = Validator::make($request->all(),[

                    'lead_name' => 'required',
                    'lead_type' => 'required',
                  

                ]);
                if($validator->fails())
                {
                    return response()->json(['error'=>$validator->errors()]);
                }
                $lead->customer_id =$request->customer_id;

            }


                $lead->lead_type = $request->lead_type;
            $lead->lead_name = $request->lead_name;
            
            $lead->save();


            }
            }


            public function leadcollect(){
                 $leads = Lead::with('leadcollection')->get();

                 return $leads;
             

            }

        
        
    
    
    
    
        }

