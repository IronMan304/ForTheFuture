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
                <div class="mb-3">
                                <a href="{{ route('service.complete.order.pdf') }}" class="btn btn-primary">Generate PDF</a>
                            </div>
                
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
            
            
            

            
            <h4 style="color:white; font-size: 30px;" align="center"> Revenues: ₱ {{ $finalTotal }}</h4>

          
           
            
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