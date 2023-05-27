<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function service_category(){
        return $this->belongsTo(ServiceCategory::class,'service_category_id','id');
    }



}
