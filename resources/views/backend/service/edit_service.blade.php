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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Service</a></li>
                                            
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Edit Service</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

<div class="row">
    

  <div class="col-lg-8 col-xl-12">
<div class="card">
    <div class="card-body">
                                    
                                      
                                         
                                           

    <!-- end timeline content-->

    <div class="tab-pane" id="settings">
        <form id="myForm" method="post" action="{{ route('service.update') }}" enctype="multipart/form-data">
        	@csrf

            <input type="hidden" name="id" value="{{ $service->id }}">

            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Edit Service</h5>

            <div class="row">


    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="firstname" class="form-label">Service Name</label>
            <input type="text" name="service_name" class="form-control" value="{{ $service->service_name }}"   >
           
        </div>
    </div>


              <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="firstname" class="form-label">Service Category </label>
            <select name="category_id" class="form-select" id="example-select">
                    <option selected disabled >Select Category </option>
                    @foreach($service_category as $cat)
        <option value="{{ $cat->id }}" {{ $cat->id == $service->service_category_id ? 'selected' : ''  }} >{{ $cat->service_category_name }}</option>
                     @endforeach
                </select>
           
        </div>
    </div>

          




              <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="firstname" class="form-label">Service Code    </label>
            <input type="text" name="service_code" class="form-control "  value="{{ $service->service_code }}"   >
            
           </div>
        </div>


     
             

            



    



    


    
              <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="firstname" class="form-label">Service Price    </label>
            <input type="text" name="avail_price" class="form-control "  value="{{ $service->avail_price }}"   >
            
           </div>
        </div>


     

   





            </div> <!-- end row -->
 
        
            
            <div class="text-end">
                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
            </div>
        </form>
    </div>
    <!-- end settings content-->
    
                                       
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
                service_name: {
                    required : true,
                }, 
                service_category_id: {
                    required : true,
                }, 
                service_code: {
                    required : true,
                }, 
                service_selling_price: {
                    required : true,
                }, 
                service_image: {
                    required : true,
                },  
            },
            messages :{
                service_name: {
                    required : 'Please Enter Service Name',
                }, 
                service_category_id: {
                    required : 'Please Select Category',
                },
                service_code: {
                    required : 'Please Enter Service Code',
                },
                service_selling_price: {
                    required : 'Please Enter Selling Price',
                },
                service_image: {
                    required : 'Please Select Service Image',
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


<script type="text/javascript">
	
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload =  function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});

</script>







@endsection