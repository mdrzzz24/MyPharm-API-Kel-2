<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory;
    protected $table = 'detail_transaction';
    protected $fillable = [
        'transaction_id',
        'product_code',
        'product_name',
        'qty',
        'price',
        'total_price',
        'payment_method',
        'transaction_date',
        'customer_name',
    ];
}
