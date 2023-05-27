<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceCategory;


use Carbon\Carbon; 
use Haruncpi\LaravelIdGenerator\IdGenerator;

use App\Exports\ServiceExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ServiceImport;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
   public function AllService(){

    $service = Service::latest()->get();
    return view('backend.service.all_service',compact('service'));

   } // End Method 

   public function AddService(){

    $service_category = ServiceCategory::latest()->get();
    return view('backend.service.add_service', compact('service_category'));
   }// End Method 


 public function StoreService(Request $request){ 

    $shortId = Str::random(6);
    $randomNumber = mt_rand(1000, 9999);
    $scode = 'SC' . $shortId . $randomNumber;
   
       
 
        

        Service::insert([

            'service_name' => $request->service_name,
            'service_category_id' => 1,
            'service_code' => $scode,
            'service_order_date' => $request->service_order_date,
            'avail_price' => $request->avail_price,
            'created_at' => Carbon::now(), 

        ]);

         $notification = array(
            'message' => 'Service Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.service')->with($notification); 
    } // End Method 



    public function EditService($id){
        $service = Service::findOrFail($id);
        $service_category = ServiceCategory::latest()->get();
        return view('backend.service.edit_service',compact('service','service_category'));

    } // End Method 



     public function UdateService(Request $request){

        $service_id = $request->id;
        $service = Service::findOrFail($service_id);
    
        $service->service_name = $request->service_name;
       
        $service->service_code = $request->service_code;
        $service->service_order_date = $request->service_order_date;
        $service->avail_price = $request->avail_price;
        $service->created_at = Carbon::now();
    
        $service->save();
    
        $notification = array(
            'message' => 'Service Updated Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.service')->with($notification);

    } // End Method 

 public function DeleteService($id){

        

        Service::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Service Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    } // End Method 


    public function BarcodeService($id){

        $service = Service::findOrFail($id);
        return view('backend.service.barcode_service',compact('service'));

    }// End Method 


    public function ImportService(){

        return view('backend.service.import_service');

    }// End Method 


    


}
