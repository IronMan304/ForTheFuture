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

   <a href="{{ route('import.service') }}" class="btn btn-info rounded-pill waves-effect waves-light">Import </a>  
   &nbsp;&nbsp;&nbsp;
   <a href="{{ route('export') }}" class="btn btn-danger rounded-pill waves-effect waves-light">Export </a>  
   &nbsp;&nbsp;&nbsp;

      <a href="{{ route('add.service') }}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Service </a>  
                                        </ol>
                                    </div>
                                    <h4 class="page-title">All Service</h4>
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
                                <th>Name</th>
                                <th>Service Category</th>
                                <th>Code</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    
    
        <tbody>
        	@foreach($service as $key=> $item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $item->service_name }}</td>
                <td>{{ $item['category']['service_category_name'] }}</td>
                <td>{{ $item->service_code }}</td>
                <td>{{ $item->avail_price }}</td>
                <td>
<a href="{{ route('edit.service',$item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light"><i class="fa fa-pencil" aria-hidden="true"></i></a>

<a href="{{ route('delete.service',$item->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light" id="delete"><i class="fa fa-trash" aria-hidden="true"></i></a>

                </td>
            </tr>
            @endforeach
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