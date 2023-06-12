<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;
    protected $table = 'pengiriman';
    protected $fillable = [
        'transaction_id',
        'pengirim',
        'telp_pengirim',
        'alamat_pengirim',
        'nama_penerima',
        'telp_penerima',
        'service',
        'ongkir',
        'kota',
        'kecamatan',
        'kelurahan',
        'kode_pos',
        'alamat_pengiriman',
        'resi',
        'status',
        'customer_name',
    ];
}
