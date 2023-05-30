<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Invoice</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    .font{
      font-size: 15px;
    }
    .authority {
        /*text-align: center;*/
        float: right
    }
    .authority h5 {
        margin-top: -10px;
        color: green;
        /*text-align: center;*/
        margin-left: 35px;
    }
    .thanks p {
        color: green;;
        font-size: 16px;
        font-weight: normal;
        font-family: serif;
        margin-top: 20px;
    }
</style>

</head>
<body>

  <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
          <!-- {{-- <img src="" alt="" width="150"/> --}} -->
          <h2 style="color: green; font-size: 26px;"><strong>WOOF! WOOF 1 K-9 Supplies</strong></h2>
        </td>
        <td align="right">
            <pre class="font" >
              WOOF! WOOF! K-9 SUPPLIES DUMAGUETE
               Email: woof2x2003@yahoo.com <br>
               Contact: (035) 422 5674 / 0917 107 3352 <br>
               Caritas Health Shield Building, Real St, Dumaguete, 6200 Negros Oriental <br>
              
            </pre>
        </td>
    </tr>

  </table>


  <table width="100%" style="background:white; padding:2px;"></table>

  <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
    <tr>
        <td>
          <p class="font" style="margin-left: 20px;">
           <strong>Customer Name:</strong> {{ $order->customer->name }}  <br>
           <strong>Customer Email:</strong> {{ $order->customer->email }}   <br>
           <strong>Customer Phone:</strong> {{ $order->customer->phone }}   <br>
          
           <strong>Address: {{ $order->customer->address }} </strong>  
        
            
         </p>
        </td>
        <td>
          <p class="font">
            <h3><span style="color: green;">Invoice:</span> # {{ $order->service_invoice_no }}  </h3>
            Order Date:  {{ $order->service_order_date }} <br>
            Order Status:  {{ $order->service_order_status }} <br>
            Payment Status: {{ $order->service_payment_status }}  <br>
            Total Pay :  {{ $order->service_pay }} <br>
            Total Due :  {{ $order->service_due }} </span>

         </p>
        </td>
    </tr>
  </table>
  <br/>
<h3>Products</h3>


  <table width="100%">
    <thead style="background-color: green; color:#FFFFFF;">
      <tr class="font">
        
        <th>Product Name</th>
        <th>Product Code</th>
       
        <th>Price</th>
        <th>Total(+Vat)</th>
      </tr>
    </thead>
    <tbody>

     @foreach($service_orderItem as $item)
      <tr class="font">
       
        <td align="center"> {{ $item->service->service_name }} </td>
        
        <td align="center"> {{ $item->service->service_code }} </td>
        

         
        
        <td align="center">${{ $item->service->avail_price }} </td>
         <td align="center">$ {{ $item->total }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <br>
  <table width="100%" style=" padding:0 10px 0 10px;">
    <tr>
        <td align="right" >
<h2><span style="color: green;">Subtotal:</span>$ {{ $order->service_sub_total }} </h2>
<h2><span style="color: green;">Total:</span> $ {{ $order->total }} </h2>
            {{-- <h2><span style="color: green;">Full Payment PAID</h2> --}}
        </td>
    </tr>
  </table>
  <div class="thanks mt-3">
    <p>Thanks For Availing Service..!!</p>
  </div>
  <div class="authority float-right mt-5">
      <p>-----------------------------------</p>
      <h5>Authority Signature:</h5>
    </div>
</body>
</html>