<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceCategory;

use Intervention\Image\Facades\Image;
use Carbon\Carbon; 
use Haruncpi\LaravelIdGenerator\IdGenerator;

use App\Exports\ServiceExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ServiceImport;

class ServiceController extends Controller
{
   public function AllService(){

    $service = Service::latest()->get();
    return view('backend.service.all_service',compact('service'));

   } // End Method 

   public function AddService(){

    $service_category = ServiceCategory::latest()->get();
    return view('backend.service.add_service',compact('service_category'));
   }// End Method 


 public function StoreService(Request $request){ 

    $scode = IdGenerator::generate(['table' => 'services','field' => 'service_code','length' => 4, 'prefix' => 'SC' ]);
 
        

        Service::insert([

            'service_name' => $request->service_name,
            'service_category_id' => $request->service_category_id,
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

        if ($request->file('service_image')) {

        $image = $request->file('service_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/service/'.$name_gen);
        $save_url = 'upload/service/'.$name_gen;

        Service::findOrFail($service_id)->update([

            'service_name' => $request->service_name,
            'service_category_id' => $request->service_category_id,
            'service_code' => $request->service_code,
            'service_order_date' => $request->service_order_date,
            'avail_price' => $request->avail_price,
            'created_at' => Carbon::now(), 

        ]);

         $notification = array(
            'message' => 'Service Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.service')->with($notification); 
             
        } else{

            Service::findOrFail($service_id)->update([

                'service_name' => $request->service_name,
                'service_category_id' => $request->service_category_id,
                'service_code' => $request->service_code,
                'service_order_date' => $request->service_order_date,
                'avail_price' => $request->avail_price,
                'created_at' => Carbon::now(), 

        ]);

         $notification = array(
            'message' => 'Service Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.service')->with($notification); 

        } // End else Condition  


    } // End Method 

 public function DeleteService($id){

        $service_img = Service::findOrFail($id);
        $img = $service_img->service_img;
        unlink($img);

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


    public function Export(){

        return Excel::download(new ServiceExport,'service.xlsx');

    }// End Method 


    public function Import(Request $request){

        Excel::import(new ServiceImport, $request->file('import_file'));

         $notification = array(
            'message' => 'Service Imported Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }// End Method 


}
