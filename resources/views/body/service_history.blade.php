@extends('admin_dashboard')
@section('admin')

 <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
      
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Complete Service Orders</h4>
                                    
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                     
                
                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Name</th>
                                
                                <th>Payment</th>
                                <th>Invoice</th>
                                <th>Pay</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    
    
        <tbody>
        @php
    $finalTotal = 0;
@endphp
@php
    $orders = App\Models\ServiceOrder::all(); // Assuming you have an "Order" model and want to fetch all orders
    $finalTotal = 0;
@endphp
        	@foreach($orders as $key=> $item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td> <img src="{{ asset($item->customer->image) }}" style="width:50px; height: 40px;"> </td>
                <td>{{ $item['customer']['name'] }}</td>
                
                <td>{{ $item->service_payment_status }}</td>
                <td>{{ $item->service_invoice_no }}</td>
                <td>{{ $item->total }}</td>
                <td> <span class="badge bg-success">{{ $item->service_order_status }}</span> </td>
                @php
            $finalTotal += $item->total;
        @endphp
                <td>
<a href="{{ url('service/order/invoice-download/'.$item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light"> PDF Service Invoice </a> 

                </td>
            </tr>
            
            @endforeach
            
            
            
            <div class="row">




<div class="col-md-3 col-xl-4">
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
                        <h4 class="text-dark mt-1">₱<span data-plugin="counterup">{{ $finalTotal }}</span></h4>
                        <p> Revenues </p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div>
    </div> <!-- end widget-rounded-circle-->
</div> <!-- end col-->



<div class="col-md-6 col-xl-4">
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
                        <h4 class="text-dark mt-1"> <span data-plugin="counterup">{{ count($servicecompleteorder)  }}</span></h4>
                        <p >Complete Order </p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div>
    </div> <!-- end widget-rounded-circle-->
</div> <!-- end col-->

<div class="col-md-6 col-xl-4">
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
                        <h4 class="text-dark mt-1"> <span data-plugin="counterup">{{ count($servicependingorder)  }}</span></h4>
                        <p >Pending Order </p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div>
    </div> <!-- end widget-rounded-circle-->
</div> <!-- end col-->
</div>
            
           

          
           
            
        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->


                      
                        
                    </div> <!-- container -->

                </div> <!-- content -->


@endsection 