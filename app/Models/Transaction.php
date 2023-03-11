<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Outlet;
use App\Models\Member;
use App\Models\TransactionDetail;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'outlet_id',
        'invoice_code',
        'member_id',
        'date',
        'deadline',
        'payment_date',
        'additional_cost',
        'discount',
        'tax',
        'total',
        'status',
        'payment_status',
        'user_id',
    ];

    public function outlet() {
        return $this->belongsTo(Outlet::class, 'outlet_id');
    }

    public function member() {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function detail() {
        return $this->hasOne(TransactionDetail::class, 'transaction_id');
    }
}
