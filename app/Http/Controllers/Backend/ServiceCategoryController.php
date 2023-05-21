<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use Carbon\Carbon;

class ServiceCategoryController extends Controller
{
    public function AllServiceCategory(){

        $service_category = ServiceCategory::latest()->get();
        return view('backend.service_category.all_service_category',compact('service_category'));

    }// End Method


    public function StoreServiceCategory(Request $request)
    {
        $validatedData = $request->validate([
            'service_category_name' => 'required',
        ]);
    
        ServiceCategory::insert([
            'service_category_name' => $validatedData['service_category_name'],
            'created_at' => Carbon::now(),
        ]);
    
        $notification = array(
            'message' => 'Service Category Inserted Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.service_category')->with($notification);
    }
    


    public function EditServiceCategory($id){
        $service_category = ServiceCategory::findOrFail($id);
        return view('backend.service_category.edit_service_category',compact('service_category'));

    }// End Method


    public function UpdateServiceCategory(Request $request){

        $service_category_id = $request->id;

        ServiceCategory::findOrFail($service_category_id)->update([
            'service_category_name' => $request->service_category_name,
            'created_at' => Carbon::now(),
        ]);

         $notification = array(
            'message' => 'ServiceCategory Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.service_category')->with($notification);   

    }// End Method


    public function DeleteServiceCategory($id){

        ServiceCategory::findOrFail($id)->delete();

         $notification = array(
            'message' => 'ServiceCategory Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);  


    }// End Method


}
 