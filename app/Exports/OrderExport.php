<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrderExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::select('product_name','order_date','order_status','product_code','product_image','product_store','buying_date','expire_date','buying_price','selling_price')->get();
    }
}
 