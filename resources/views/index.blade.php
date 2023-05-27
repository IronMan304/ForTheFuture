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
                                    <h4 class="page-title">Dashboard</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

<div class="row">




<div class="col-md-3 col-xl-3">
    <div class="widget-rounded-circle card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-success border-success border shadow">
                        <i class="fe-shopping-cart font-22 avatar-title text-white"></i>
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
                    <div class="avatar-lg rounded-circle bg-success border-success border shadow">
                        <i class="fe-shopping-cart font-22 avatar-title text-white"></i>
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
                    <div class="avatar-lg rounded-circle bg-info border-info border shadow">
                        <i class="fe-bar-chart-line- font-22 avatar-title text-white"></i>
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

<div class="col-md-6 col-xl-3">
    <div class="widget-rounded-circle card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-warning border-warning border shadow">
                        <i class="fe-eye font-22 avatar-title text-white"></i>
                    </div>
                </div>
                <div class="col-6">
                   <div class="text-end">
                        <h4 class="text-dark mt-1"> <span data-plugin="counterup">{{ count($pendingorder)  }}</span></h4>
                        <p >Pending Order </p>
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