<div class="left-side-menu">

<div class="h-100" data-simplebar>

    <!-- User box -->


    <!--- Sidemenu -->
    <div id="sidebar-menu">

        <ul id="side-menu">
            
        <li class="menu-title">Navigation</li>

<li>
    <a href="#sidebarDashboards" data-bs-toggle="collapse">
        <i class="mdi mdi-view-dashboard-outline"></i>
        <span class="badge bg-success rounded-pill float-end"></span>
        <span> Dashboards </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="sidebarDashboards">
        <ul class="nav-second-level">
            <li>
                <a href="{{ url('/dashboard') }}">Overall Dashboard</a>
            </li>
            <li>
                <a href="{{ url('/product_dashboard') }}">Product Dashboard</a>
            </li>
            <li>
                <a href="{{ url('/service_dashboard') }}">Service Dashboard</a>
            </li>
           
        </ul>
    </div>
</li>

            







@if(Auth::user()->can('pos.menu'))
<li class="menu-title mt-2">Cashier</li>
<li>
<a href="{{ route('pos') }}">
<span class="badge bg-pink float-end">Product</span>
<i class="mdi mdi-cart"></i>
<span> Buy </span>
</a>
</li>

<li>
<a href="{{ route('service.pos') }}">
<span class="badge bg-pink float-end">Service</span>
<i class="mdi mdi-credit-card"></i>
<span> Avail </span>
</a>
</li>


@endif




          

           

            
@if(Auth::user()->can('customer.menu'))
<li class="menu-title mt-2">Business</li>
<li>
<a href="#sidebarCrm" data-bs-toggle="collapse">
    <i class="mdi mdi-account-multiple-outline"></i>
    <span> Customer Manage   </span>
    <span class="menu-arrow"></span>
</a>
<div class="collapse" id="sidebarCrm">
    <ul class="nav-second-level">
@if(Auth::user()->can('customer.all'))
<li>
<a href="{{ route('all.customer') }}">All Customer</a>
</li>
@endif
@if(Auth::user()->can('customer.add'))
<li>
<a href="{{ route('add.customer') }}">Add Customer</a>
</li>
@endif
         
    </ul>
</div>
</li>
@endif

@if(Auth::user()->can('supplier.menu'))
<li>
<a href="#sidebarEmail" data-bs-toggle="collapse">
<i class="mdi mdi-account-multiple-outline"></i>
<span> Supplier Manage </span>
<span class="menu-arrow"></span>
</a>
<div class="collapse" id="sidebarEmail">
<ul class="nav-second-level">
    <li>
        <a href="{{ route('all.supplier') }}">All Supplier</a>
    </li>
    <li>
        <a href="{{ route('add.supplier') }}">Add Supplier</a>
    </li>
    
</ul>
</div>
</li>
@endif





@if(Auth::user()->can('employee.menu'))
<li class="menu-title mt-2">Management</li>
<li>
<a href="#sidebarEcommerce" data-bs-toggle="collapse">
<i class="mdi mdi-account-multiple-outline"></i>
<span> Employee Manage  </span>
<span class="menu-arrow"></span>
</a>
<div class="collapse" id="sidebarEcommerce">
<ul class="nav-second-level">
@if(Auth::user()->can('employee.all'))
<li>
    <a href="{{ route('all.employee') }}">All Employee</a>
</li>
@endif
@if(Auth::user()->can('employee.add'))
<li>
    <a href="{{ route('add.employee') }}">Add Employee </a>
</li>
@endif
</ul>
</div>
</li>
@endif

@if(Auth::user()->can('salary.menu'))
<li>
<a href="#salary" data-bs-toggle="collapse">
<i class="mdi mdi-wallet"></i>
<span> Employee Salary </span>
<span class="menu-arrow"></span>
</a>
<div class="collapse" id="salary">
<ul class="nav-second-level">
    <li>
        <a href="{{ route('add.advance.salary') }}">Add Advance Salary</a>
    </li>
    <li>
        <a href="{{ route('all.advance.salary') }}">All Advance Salary</a>
    </li>

     <li>
        <a href="{{ route('pay.salary') }}">Pay Salary</a>
    </li> 

    <li>
        <a href="{{ route('month.salary') }}">Last Month Salary</a>
    </li>
    
</ul>
</div>
</li>
@endif


@if(Auth::user()->can('attendence.menu'))
<li>
<a href="#attendence" data-bs-toggle="collapse">
<i class="mdi mdi-calendar-check"></i>
<span> Employee Attendence </span>
<span class="menu-arrow"></span>
</a>
<div class="collapse" id="attendence">
<ul class="nav-second-level">
    <li>
        <a href="{{ route('employee.attend.list') }}">Employee Attendence List </a>
    </li>

</ul>
</div>
</li>

@endif



@if(Auth::user()->can('category.menu'))
<li class="menu-title mt-2">Product Menu</li>
<li>
<a href="#category" data-bs-toggle="collapse">
<i class="mdi mdi-view-list"></i>
<span> Product Category </span>
<span class="menu-arrow"></span>
</a>
<div class="collapse" id="category">
<ul class="nav-second-level">
    <li>
        <a href="{{ route('all.category') }}">All Category </a>
    </li>

</ul>
</div>
</li>
@endif

@if(Auth::user()->can('product.menu'))
<li>
<a href="#product" data-bs-toggle="collapse">
<i class="mdi mdi-package"></i>
<span> Products  </span>
<span class="menu-arrow"></span>
</a>
<div class="collapse" id="product">
<ul class="nav-second-level">
    <li>
        <a href="{{ route('all.product') }}">All Product </a>
    </li>

     <li>
        <a href="{{ route('add.product') }}">Add Product </a>
    </li>
 
</ul>
</div>
</li>
@endif

@if(Auth::user()->can('orders.menu'))
<li>
<a href="#orders" data-bs-toggle="collapse">
<i class="mdi mdi-cart"></i>
<span> Product Orders  </span>
<span class="menu-arrow"></span>
</a>
<div class="collapse" id="orders">
<ul class="nav-second-level">

<li>
<a href="{{ route('pending.order') }}">Pending Orders </a>
</li>

<li>
<a href="{{ route('complete.order') }}">Complete Orders </a>
</li>




</ul>
</div>
</li>
@endif

@if(Auth::user()->can('stock.menu'))

<li>
<a href="#stock" data-bs-toggle="collapse">
<i class="mdi mdi-archive"></i>
<span> Inventory   </span>
<span class="menu-arrow"></span>
</a>
<div class="collapse" id="stock">
<ul class="nav-second-level">
<li>
<a href="{{ route('stock.manage') }}">Stock </a>
</li>


</ul>
</div>
</li>
@endif

@if(Auth::user()->can('service.menu'))
<li class="menu-title mt-2">Service Menu</li>

<li>
<a href="#serviceCategory" data-bs-toggle="collapse">
<i class="mdi mdi-view-list"></i>
<span> Service Category </span>
<span class="menu-arrow"></span>
</a>
<div class="collapse" id="serviceCategory">
<ul class="nav-second-level">
    <li>
        <a href="{{ route('all.service_category') }}">All Category </a>
    </li>

</ul>
</div>
</li>



<li>
<a href="#service" data-bs-toggle="collapse">
<i class="mdi mdi-tools"></i>
<span> Services  </span>
<span class="menu-arrow"></span>
</a>
<div class="collapse" id="service">
<ul class="nav-second-level">
    <li>
        <a href="{{ route('all.service') }}">All Service </a>
    </li>

     <li>
        <a href="{{ route('add.service') }}">Add Service </a>
    </li>
     

</ul>
</div>
</li>



<li>
<a href="#service_orders" data-bs-toggle="collapse">
<i class="mdi mdi-cart"></i>
<span> Service Orders  </span>
<span class="menu-arrow"></span>
</a>
<div class="collapse" id="service_orders">
<ul class="nav-second-level">
<li>
<a href="{{ route('service_pending.order') }}">Pending Service </a>
</li>

<li>
<a href="{{ route('service_complete.order') }}">Complete Service </a>
</li>



</ul>
</div>
</li>
@endif



             
          

           

@if(Auth::user()->can('expense.menu'))
<li class="menu-title mt-2">Expenses</li>
        <li>
            <a href="#sidebarAuth" data-bs-toggle="collapse">
            <i class="mdi mdi-currency-usd"></i>
                <span>Expense </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarAuth">
<ul class="nav-second-level">
<li>
<a href="{{ route('add.expense') }}">Add Expense</a>
</li>
<li>
<a href="{{ route('today.expense') }}">Today Expense</a>
</li>
<li>
<a href="{{ route('month.expense') }}">Monthly Expense</a>
</li>
<li>
<a href="{{ route('year.expense') }}">Yearly Expense</a>
</li>

</ul>
            </div>
        </li>

@endif





         

         

          

               
                    </ul>
                </div>
            </li>
        </ul>

    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>

</div>
<!-- Sidebar -left -->

</div>