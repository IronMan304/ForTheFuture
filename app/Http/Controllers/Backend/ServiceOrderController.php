<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\ServiceOrder;
use App\Models\ServiceOrderdetails;
use Carbon\Carbon; 
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ServiceOrderController extends Controller
{


    public function ServiceFinalInvoice(Request $request){

        $rtotal = $request->total;
        $rpay = $request->pay;
        $mtotal = $rtotal - $rpay;

        $data = array();
        $data['customer_id'] = $request->customer_id;
        $data['service_order_date'] = $request->service_order_date;
        $data['service_order_status'] = $request->service_order_status;
        $data['total_services'] = $request->total_services;
        $data['service_sub_total'] = $request->service_sub_total;
        $data['service_vat'] = $request->service_vat;

        $data['service_invoice_no'] = 'SIN'.mt_rand(10000000,99999999);
        $data['total'] = $request->total;
        $data['service_payment_status'] = $request->payment_status;
        $data['service_pay'] = $request->pay;
        $data['service_due'] = $mtotal;
        $data['created_at'] = Carbon::now(); 

        $service_order_id = ServiceOrder::insertGetId($data);
        $contents = Cart::content();
 
        $sdata = array();
        foreach($contents as $content){
            $sdata['service_order_id'] = $service_order_id;
            $sdata['service_id'] = $content->id;
            $sdata['total'] = $content->total;
            
            $insert = ServiceOrderdetails::insert($sdata); 

        } // end foreach


        $notification = array(
            'message' => 'Service Order Complete Successfully',
            'alert-type' => 'success'
        );

        Cart::destroy();

        return redirect()->route('dashboard')->with($notification);

    } // End Method 


    public function ServicePendingOrder(){

        $orders = ServiceOrder::where('service_order_status','pending')->get();
        return view('backend.service_order.service_pending_order',compact('orders'));

    }// End Method 

     public function ServiceCompleteOrder(){

        $orders = ServiceOrder::where('service_order_status','complete')->get();
        return view('backend.service_order.service_complete_order',compact('orders'));

    }// End Method 


    public function ServiceOrderDetails($service_order_id){

        $service_order = ServiceOrder::where('id',$service_order_id)->first();

        $service_orderItem = ServiceOrderdetails::with('service')->where('service_order_id',$service_order_id)->orderBy('id','DESC')->get();
        return view('backend.service_order.service_order_details',compact('service_order','service_orderItem'));

    }// End Method 


    public function ServiceOrderStatusUpdate(Request $request){

        $service_order_id = $request->id;


    $service = ServiceOrderdetails::where('service_order_id',$service_order_id)->get();
        

     ServiceOrder::findOrFail($service_order_id)->update(['service_order_status' => 'complete']);

         $notification = array(
            'message' => 'Service Order Done Successfully',
            'alert-type' => 'success'
        ); 

        return redirect()->route('service_pending.order')->with($notification);


    }// End Method 




    public function ServiceOrderInvoice($service_order_id){

         $order = ServiceOrder::where('id',$service_order_id)->first();

        $service_orderItem = ServiceOrderdetails::with('service')->where('service_order_id',$service_order_id)->orderBy('id','DESC')->get();

        $pdf = Pdf::loadView('backend.service_order.service_order_invoice', compact('order','service_orderItem'))->setPaper('a4')->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),

        ]);
         return $pdf->download('service_invoice.pdf');

    }// End Method 



    


    public function ServiceUpdateDue(Request $request){

        $service_order_id = $request->id;
        $due_amount = $request->due;
        $pay_amount = $request->pay;

        $allorder = ServiceOrder::findOrFail($service_order_id);
        $maindue = $allorder->due;
        $maindpay = $allorder->pay;
 
        $paid_due = $maindue - $due_amount;
        $paid_pay = $maindpay + $due_amount;

        ServiceOrder::findOrFail($service_order_id)->update([
            'due' => $paid_due,
            'pay' => $paid_pay, 
        ]);

         $notification = array(
            'message' => 'Due Amount Updated Successfully',
            'alert-type' => 'success'
        ); 

        return redirect()->route('service_pending.due')->with($notification);


    }// End Method 


}
 