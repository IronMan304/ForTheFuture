@extends('admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

 <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">POS</a></li>
                                            
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Avail Service</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

<div class="row">
    <div class="col-lg-6 col-xl-6">
        <div class="card text-center">
            <div class="card-body"> 



<div class="table-responsive">
        <table class="table table-bordered border-primary mb-0">
            <thead>
                <tr>
                    
                    <th>Service</th>
                    <th>Price</th>
                    <th>SubTotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            

            @php
            $allcart = Cart::content();
            @endphp
            <tbody>
                @foreach($allcart as $cart)
                <tr>
                    <td>{{ $cart->name }}</td>
                 
                    
                   
                    <td>{{ $cart->price }}</td>
                    <td>{{ $cart->price*$cart->qty }}</td>
                    <td>
    <a href="{{ url('/cart-remove/'.$cart->rowId) }}" class="remove-button" data-service-id="{{ $cart->id }}">
        <i class="fas fa-trash-alt" style="color:#ffffff"></i>
    </a>
</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="bg-primary">
        <br>
        
        
        
        <p style="font-size:18px; color:#fff"> SubTotal : {{ Cart::subtotal() }} </p>
        <p style="font-size:18px; color:#fff"> Vat : {{ Cart::tax() }} </p>
        <p><h2 class="text-white"> Total </h2> <h1 class="text-white"> {{ Cart::total() }}</h1>   </p>
         <br>
    </div>

 <br>
    <form id="myForm" method="post" action="{{ url('/create-service-invoice') }}">
        @csrf

       
     
        <div class="form-group mb-3">
           

              <a href="{{ route('add.customer') }}" class="btn btn-primary rounded-pill waves-effect waves-light mb-2">Add Customer </a>  
                <hr>
              <label for="firstname" class="form-label">All Customer </label>
              <table id="customer-table" class="table table-bordered table-dark">
                                    <thead>
                                        <tr>
                                            <th>Customer ID</th>
                                            <th>Customer Name</th>
                                            <th>Select</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customer as $cus)
                                        <tr>
                                            <td>{{ $cus->id }}</td>
                                            <td>{{ $cus->name }}</td>
                                            <td>
                                                <input type="radio" name="customer_id" value="{{ $cus->id }}">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                </table>

                               

                                    <script>
                                        $(document).ready(function() {
                                            $('#customer-table').DataTable({
                                                "paging": true,
                                                "lengthMenu": [5, 10, 25, 50],
                                                "pageLength": 5
                                            });
                                        });
                                </script>
                                
           
           
        </div>
    
        <button class="btn btn-blue waves-effect waves-light">Create Invoice</button>


    </form>






                                   
 
            </div>                                 
        </div> <!-- end card -->

                                

                            </div> <!-- end col-->

                            <div class="col-lg-6 col-xl-6">
                                <div class="card">
                                    <div class="card-body"> 
                                           

    <!-- end timeline content-->



    
    

<table id="service-table" class="table dt-responsive nowrap w-100 table-dark">
  <thead>
    <tr>
      <th>Sl</th>
      <th>Service</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($service as $key => $item)
    <tr>
      <form method="post" action="{{ url('/add-cart') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $item->id }}">
        <input type="hidden" name="name" value="{{ $item->service_name }}">
        <input type="hidden" name="qty" value="1">
        <input type="hidden" name="price" value="{{ $item->avail_price }}">
        <td>{{ $key+1 }}</td>
        <td>{{ $item->service_name }}</td>
        <td>
          <button type="submit" style="font-size: 20px; color: #000;" class="add-button" data-service-id="{{ $item->id }}" data-row-id="{{ $item->rowId }}" {{ Cart::count() > 0 ? 'disabled' : '' }}>
            <i class="fas fa-plus-square"></i> 
          </button>
        </td>
      </form>
    </tr>
    @endforeach
  </tbody>
</table>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

<script>
  $(document).ready(function() {
    var dataTable = $('#service-table').DataTable({
      paging: true,
      lengthChange: false,
      searching: true,
      info: false,
      pageLength: 10,
      columnDefs: [{
        targets: [0, 2],
        orderable: false
      }]
    });
    
    $('#searchInput').on('keyup', function() {
      dataTable.search(this.value).draw();
    });
  });
</script>


             
    
    
    
    
                                       
                                    </div>
                                </div> <!-- end card-->

                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->

                    </div> <!-- container -->

                </div> <!-- content -->


 
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                customer_id: {
                    required : true,
                }, 
                
            },
            messages :{
                customer_id: {
                    required : 'Please Select Customer',
                }, 
               

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>










@endsection