<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    protected $fillable = [
        'product_code',
        'product_name',
        'price',
        'qty',
        'total_price',
        'transaction_date',
        'payment_method',
        'payment_status',
        'customer_name',
    ];
}
