@extends('admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>



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
                    <h4 class="page-title">Order Product</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
       
        <div class="row">
            <div class="col-lg-6 col-xl-6">
                <div class="card text-center">
                    <div class="card-body">
                        <!-- ... -->
                        <div class="table-responsive">
                        <table class="table table-bordered border-primary mb-0">
    <thead>
        <tr>
            <th>Name</th>
            <th>QTY</th>
            <th>Price</th>
            <th>SubTotal</th>
            
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php
        $allcart = Cart::content();
        @endphp

        @foreach($allcart as $cart)
        <tr>
            <td>{{ $cart->name }}</td>
            <td>
                <form method="post" action="{{ url('/cart-update/'.$cart->rowId) }}">
                    @csrf

                    @php
                    $item = $product->firstWhere('id', $cart->id);
                    $maxQty = $item ? $item->product_store : 0;
                    @endphp

                    <input type="number" name="qty" value="{{ $cart->qty }}" style="width:40px;" min="1" max="{{ $maxQty }}" onchange="validateQuantity(this)">
                    <button type="submit" class="btn btn-sm btn-success" style="margin-top:-2px ;">
                        <i class="fas fa-check"></i>
                    </button>
                </form>
            </td>
            <td>{{ $cart->price }}</td>
            <td>{{ $cart->price * $cart->qty }}</td>
           
            <td>
                <a href="{{ url('/cart-remove/'.$cart->rowId) }}">
                    <i class="fas fa-trash-alt" style="color:#ffffff"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

    
    <table id="basic-datatable" class="table dt-responsive nowrap w-100"></table>
</div>

                        <!-- ... -->
                        <div class="bg-primary">
                            <br>
                            <p style="font-size:18px; color:#fff"> Quantity: {{ Cart::count() }} </p>
                            <p style="font-size:18px; color:#fff"> SubTotal: {{ Cart::subtotal() }} </p>
                            <p style="font-size:18px; color:#fff"> Vat: {{ Cart::tax() }} </p>
                            <p>
                                <h2 class="text-white">Total</h2>
                                <h1 class="text-white">{{ Cart::total() }}</h1>
                            </p>
                            <br>
                        </div>

                        <br>
                        <form id="myForm" method="post" action="{{ url('/create-invoice') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="firstname" class="form-label">All Customer</label>
                                <a href="{{ route('add.customer') }}" class="btn btn-primary rounded-pill waves-effect waves-light mb-2">Add Customer</a>
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
                                        $("#customer-search").on("keyup", function() {
                                            var value = $(this).val().toLowerCase();
                                            $(".customer-row").filter(function() {
                                                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                            });
                                        });
                                    });
                                </script>

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
                </div>
            </div> <!-- end card -->
           
            <div class="col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-pane" id="settings">
             
<table id="product-table" class="table dt-responsive nowrap w-100">
  <thead>
    <tr>
      <th>Sl</th>
    
      <th>Category</th>
      <th>Product</th>
      <th>Stock</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($product as $key => $item)
    <tr>
      <form method="post" action="{{ url('/add-cart') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $item->id }}">
        <input type="hidden" name="name" value="{{ $item->product_name }}">
        <input type="hidden" name="qty" value="1">
        <input type="hidden" name="price" value="{{ $item->selling_price }}">
        <td>{{ $key+1 }}</td>
       
        <td>{{ $item->category->category_name }}</td>
        <td>{{ $item->product_name }}</td>
        <td>{{ $item->product_store }}</td>
        <td>
        @php
                                                $addedProduct = false;
                                                foreach ($allcart as $cart) {
                                                    if ($cart->name === $item->product_name) {
                                                        $addedProduct = true;
                                                        break;
                                                    }
                                                }
                                                @endphp
                                                @if (!$addedProduct)
          @if($item->product_store <= 0)
          <button type="button" class="btn btn-secondary" disabled>Out of Stock</button>
          @else
          <button type="submit" style="font-size: 20px; color: #000;">
            <i class="fas fa-plus-square"></i>
          </button>
          @endif
          @endif
        </td>
      </form>
    </tr>
    @endforeach
  </tbody>
</table>

<script>
  var searchInput = document.getElementById('searchInput');
  var tableRows = document.getElementById('product-table').getElementsByTagName('tr');

  searchInput.addEventListener('input', function() {
    var filter = searchInput.value.toLowerCase();

    for (var i = 1; i < tableRows.length; i++) {
      var productName = tableRows[i].getElementsByTagName('td')[3];
      if (productName) {
        var productText = productName.textContent || productName.innerText;
        if (productText.toLowerCase().indexOf(filter) > -1) {
          tableRows[i].style.display = '';
        } else {
          tableRows[i].style.display = 'none';
        }
      }
    }
  });
</script>



                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
      
        <!-- end row-->
    </div> <!-- container -->
</div> <!-- content -->

<script type="text/javascript">
    $(document).ready(function () {
        $('#myForm').validate({
            rules: {
                customer_id: {
                    required: true,
                },
            },
            messages: {
                customer_id: {
                    required: 'Please Select Customer',
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });

    function validateQuantity(input) {
        var maxStock = parseInt(input.getAttribute('product_store'));
        var quantity = parseInt(input.value);
        if (quantity > maxStock) {
            alert("Input value cannot exceed the current stock available!");
            input.value = maxStock;
        }
    }
</script>



                                <script>
                                    $(document).ready(function() {
                                        $('#product-table').DataTable({
                                            "paging": true,
                                            "lengthMenu": [5, 10, 25, 50],
                                            "pageLength": 5
                                        });
                                    });
                                </script>
                                <style>
  #product-table_filter input[type="search"] {
    width: 100px; /* Adjust the width as needed */
    height: 36px; /* Adjust the height as needed */
    padding: 4px 8px; /* Adjust the padding as needed */
    font-size: 14px; /* Adjust the font size as needed */
  }
</style>
<style>
  #customer-table_filter input[type="search"] {
    width: 100px; /* Adjust the width as needed */
    height: 36px; /* Adjust the height as needed */
    padding: 4px 8px; /* Adjust the padding as needed */
    font-size: 14px; /* Adjust the font size as needed */
  }
</style>

@endsection