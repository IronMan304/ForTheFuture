@extends('admin_dashboard')
@section('admin')

@php
 $date = date('d-F-Y');
 $today_paid = App\Models\Order::where('order_date',$date)->sum('pay');

 $total_paid = App\Models\Order::sum('pay');
 $total_due = App\Models\Order::sum('due'); //Profit
 $buying_price = App\Models\Product::sum('buying_price');

 $product_store = App\Models\Product::sum('product_store');

 $total_expenses = $buying_price*$product_store;


 $completeorder = App\Models\Order::where('order_status','complete')->get(); 

  $pendingorder = App\Models\Order::where('order_status','pending')->get(); 

@endphp

 <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                       
                                    </div>
                                    <h4 class="page-title">Product Dashboard</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

<div class="row">


<style> .left-50 {
    left: 22%;
    transform: translateX(-50%);
}
.top-50 {
    top: 100%;
    transform: translateY(-50%);
}
</style>
<div class="col-md-3 col-xl-3">
    <div class="widget-rounded-circle card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                <div class="avatar-lg rounded-circle bg-success border-success border shadow d-flex justify-content-center align-items-center">
                
   
    <i class="fas fa-regular fa-money-bill fa-spin font-22 text-white"></i>
</div>

                  
                </div>
                <div class="col-6">
                      <div class="text-end">
                        <h4 class="text-dark mt-1">₱<span data-plugin="counterup">{{ $total_expenses  }}</span></h4>
                        <p> Product Expenses </p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div>
    </div> <!-- end widget-rounded-circle-->
</div> <!-- end col-->

<div class="col-md-2 col-xl-3">
    <div class="widget-rounded-circle card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                <div class="avatar-lg rounded-circle bg-success border-success border shadow d-flex justify-content-center align-items-center">
    
    <i class="fas fa-duotone fa-wallet fa-beat-fade font-22  text-white"></i>
</div>

                </div>
                <div class="col-6">
                      <div class="text-end">
                        <h4 class="text-dark mt-1">₱<span data-plugin="counterup">{{ $total_due  }}</span></h4> <!--profit -->
                        <p class="text-muted mb-1 text-truncate"> Profit </p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div>
    </div> <!-- end widget-rounded-circle-->
</div> <!-- end col-->

<div class="col-md-6 col-xl-3">
    <div class="widget-rounded-circle card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-info border-info border shadow d-flex justify-content-center align-items-center">
                       
                        <i class="fas fa-duotone fa-box fa-bounce font-22  text-white "></i>
                    </div>
                </div>
                <div class="col-6">
                   <div class="text-end">
                        <h4 class="text-dark mt-1"> <span data-plugin="counterup">{{ count($completeorder)  }}</span></h4>
                        <p >Complete Order </p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div>
    </div> <!-- end widget-rounded-circle-->
</div> <!-- end col-->

@php
    $finalTotal = 0;
@endphp
@php
    $orders = App\Models\Order::all(); // Assuming you have an "Order" model and want to fetch all orders
    $finalTotal = 0;
@endphp
        	@foreach($orders as $key=> $item)
            
                
                
                
                @php
            $finalTotal += $item->total;
        @endphp
                @endforeach
<div class="col-md-6 col-xl-3">
    <div class="widget-rounded-circle card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                <div class="avatar-lg rounded-circle bg-info border-info border shadow d-flex justify-content-center align-items-center">
                       
                       <i class="fas fa-duotone fa-money-bill-transfer fa-spin fa-spin-reverse font-22  text-white "></i>
                   </div>
                </div>
                <div class="col-6">
                   <div class="text-end">
                 
                        <h4 class="text-dark mt-1">₱ <span data-plugin="counterup">{{ $finalTotal }}</span></h4>
                        <p >Revenues </p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div>
    </div> <!-- end widget-rounded-circle-->
</div> <!-- end col-->
</div>
                        <!-- end row-->

                        
                        <!-- end row -->

                        <div class="row">
                         

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                      
    
                                        <h4 class="header-title mb-3"> History</h4>
    
                                        <div class="table-responsive">
                                           
                                        @include('body.history')
        
                                        </div> <!-- end .table-responsive-->
                                        
                                    </div>
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->
@endsection