
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
                                <th>Order Date</th>
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
    $orders = App\Models\Order::all(); // Assuming you have an "Order" model and want to fetch all orders
    $finalTotal = 0;
@endphp
        	@foreach($orders as $key=> $item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td> <img src="{{ asset($item->customer->image) }}" style="width:50px; height: 40px;"> </td>
                <td>{{ $item['customer']['name'] }}</td>
                <td>{{ $item->order_date }}</td>
                <td>{{ $item->payment_status }}</td>
                <td>{{ $item->invoice_no }}</td>
                <td>{{ $item->total }}</td>
                <td> <span class="badge bg-success">{{ $item->order_status }}</span> </td>
                @php
            $finalTotal += $item->total;
        @endphp
                <td>
<a href="{{ url('order/invoice-download/'.$item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light"> PDF Invoice </a> 

                </td>
            </tr>
            
            @endforeach
            
            
            
            <h3 class="header-title mb-3"> Revenue: ₱{{ $finalTotal }}</h3>
            
    

          
           
            
        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->


                      
                        
                    </div> <!-- container -->

                </div> <!-- content -->

