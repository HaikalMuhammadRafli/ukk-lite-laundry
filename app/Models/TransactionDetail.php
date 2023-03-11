<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'transaction_details';

    protected $fillable = [
        'transaction_id',
        'package_id',
        'qty',
        'description',
    ];

    public function package() {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
