<!-- complete_order_pdf.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Completed Orders</title>
    <style>
        /* Customize your PDF layout styles here */
        /* Example: */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Completed Orders</h2>
    <table>
        <thead>
            <tr>
                <th>Sl</th>
                <th>Customer Name</th>
                <th>Order Date</th>
                <th>Payment Status</th>
                <th>Invoice No</th>
                <th>Total</th>
                <th>Order Status</th>
            </tr>
        </thead>
        <tbody>
            @php
            $totalSales = 0;
            @endphp
            @foreach ($service_orders as $key => $order)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $order->customer->name }}</td>
                <td>{{ $order->service_order_date }}</td>
                <td>{{ $order->service_payment_status }}</td>
                <td>{{ $order->service_invoice_no }}</td>
                <td>{{ $order->total }}</td>
                <td>{{ $order->service_order_status }}</td>
            </tr>
            @php
            $totalSales += $order->total;
            @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5">Total Sales:</th>
                <th colspan="2">{{ $totalSales }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
