<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Customer;
use Gloudemans\Shoppingcart\Facades\Cart;


class ServicePosController extends Controller
{
    public function ServicePos(){
        $service = Service::latest()->get();
        $customer = Customer::latest()->get();
        return view('backend.service_pos.service_pos_page',compact('service','customer'));

    } // End Method 


    public function AddCart(Request $request){

        Cart::add([
            'id' => $request->id, 
            'name' => $request->name, 
            'qty' => $request->qty, 
            'price' => $request->price, 
            'weight' => 20, 
            'options' => ['size' => 'large']]);


         $notification = array(
            'message' => 'Product Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    } // End Method 


    public function AllItem(){

        $service_item = Cart::content();

        return view('backend.service_pos.service_text_item',compact('service_item'));

    } // End Method 


    public function CartUpdate(Request $request,$rowId){

        $qty = $request->qty;
        $update = Cart::update($rowId,$qty);
         
         $notification = array(
            'message' => 'Cart Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method 


    public function CartRemove($rowId){

        Cart::remove($rowId);

        $notification = array(
            'message' => 'Cart Remove Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method 


    public function CreateInvoice(Request $request){

         $contents = Cart::content();
         $cust_id = $request->customer_id;
         $customer = Customer::where('id',$cust_id)->first();
         return view('backend.invoice.product_invoice',compact('contents','customer'));

    } // End Method 


}
 