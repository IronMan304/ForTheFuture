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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Customer Invoice</a></li>
                                           
                                            
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Customer Invoice</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

<div class="row">
<div class="col-12">
<div class="card">
    <div class="card-body">
        <!-- Logo & title -->
        <div class="clearfix">
            <div class="float-start">
                <div class="auth-logo">
                    <div class="logo logo-dark">
                        <span class="logo-lg">
                            <img src="{{ asset('backend/assets/images/woof!-logo.jpg') }}" alt="" height="50">
                        </span>
                    </div>

                    <div class="logo logo-light">
                        <span class="logo-lg">
                            <img src="{{ asset('backend/assets/images/woof!-logo.jpg') }}" alt="" height="50">
                        </span>
                    </div>
                </div>
            </div>
            <div class="float-end">
                <h4 class="m-0 d-print-none">Invoice</h4>
            </div>
        </div>
            
                <div class="row">
                    <div class="col-md-6">
                        <div class="mt-3">
                            <p><b>Hello, {{ $customer->name }}</b></p>
                            
                        </div>

                </div><!-- end col -->
                <div class="col-md-4 offset-md-2">
                    <div class="mt-3 float-end">
               <!-- Your other form fields -->
@php
    $serviceOrderDate = date('Y-m-d'); // Replace with the desired date in the format 'Y-m-d'
@endphp
<div class="form-group">
    <label for="service_order_date">Order Date:</label>
    <input type="date" name="service_order_date" class="form-control" value="{{ $serviceOrderDate }}" readonly required>
</div>
<!-- Your other form fields -->
    

                        <p><strong>Order Status : </strong> <span class="float-end"><span class="badge bg-danger">Unpaid</span></span></p>
                        <p><strong>Invoice No. : </strong> <span class="float-end">000028 </span></p>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

            <div class="row mt-3">
                <div class="col-sm-6">
                    <h6>Billing Address</h6>
                    <address>
                    	{{ $customer->address }}
                        <br>

    <abbr title="Phone">Phone : </abbr> {{ $customer->phone }}<br>
    <abbr title="Phone">Email : </abbr> {{ $customer->email }}<br>
                    </address>
                </div> <!-- end col -->

               
            </div> 
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
        <table class="table mt-4 table-centered">
            <thead>
            <tr><th>#</th>
                <th>Service</th>
                
                <th style="width: 10%">Service Cost</th>
                <th>Avail Date</th>
                <th style="width: 10%" class="text-end">Total</th>
            </tr></thead>
            <tbody>
            @php
            $sl = 1;
            @endphp
            <input type="hidden" name="service_order_date" value="{{ date('d-F-Y') }}">
            @foreach($contents as $key=> $item)
            <tr>
                <td>{{ $sl++ }}</td>
                <td>
                    <b>{{ $item->name }}</b> <br/>
                    
                </td>
                <td>{{ $item->price }}</td>
                <td>{{ date('d-F-Y') }}</td>
                <td class="text-end">₱{{ $item->price*$item->qty }}</td>
            </tr>
            @endforeach

            </tbody>
        </table>
                    </div> <!-- end table-responsive -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-sm-6">
                    <div class="clearfix pt-5">
                        <h6 class="text-muted">Notes:</h6>

                        
                    </div>
                </div> <!-- end col -->
                <div class="col-sm-6">
                    <div class="float-end">
    <p><b>Sub-total:</b> <span class="float-end">₱{{ Cart::subtotal() }}</span></p>
    <p><b>Vat (21%):</b> <span class="float-end"> &nbsp;&nbsp;&nbsp; ₱{{ Cart::tax() }}</span></p>
    <h3>₱{{ Cart::total() }} </h3>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->

            <div class="mt-4 mb-1">
                <div class="text-end d-print-none">
                    <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-printer me-1"></i> Print</a>
   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signup-modal">Create Service Invoice </button> 
                </div>
            </div>
        </div>
    </div> <!-- end card -->
</div> <!-- end col -->
</div>
                        <!-- end row --> 
                        
                    </div> <!-- container -->

                </div> <!-- content -->



          <!-- Signup modal content -->
<div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body"> 
            	<div class="text-center mt-2 mb-4 ">
            			<div class="auth-logo">
            				<h3>Invoice Of {{ $customer->name }}</h3>
            				<h3>Total Amount  ${{ Cart::total() }}</h3>
            			</div>
            	</div>




  <form class="px-3" method="post" action="{{ url('service/final-invoice') }}">
                    @csrf

                    <div class="mb-3">
             <label for="username" class="form-label">Payment</label>
    

    <select name="payment_status" class="form-select" id="example-select">
                    <option selected disabled >Select Payment </option>
                    
        <option value="HandCash">HandCash</option>
        
                   
                </select>
                    </div>

                        <div class="mb-3">
             <label for="username" class="form-label">Pay Now</label>
     <input class="form-control" type="text" name="pay" placeholder="Pay Now">
                    </div>

 

   <input type="hidden" name="customer_id" value="{{ $customer->id }}">
   <input type="hidden" name="service_order_date" value="{{ date('d-F-Y') }}">
   <input type="hidden" name="service_order_status" value="pending">
   <input type="hidden" name="total_services" value="{{ Cart::count() }}">
   <input type="hidden" name="service_sub_total" value="{{ Cart::subtotal() }}">
   <input type="hidden" name="service_vat" value="{{ Cart::tax() }}">
   <input type="hidden" name="total" value="{{ Cart::total() }}"> 

 

                    <div class="mb-3 text-center">
     <button class="btn btn-primary" type="submit">Complete Service Avail </button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
         





@endsection