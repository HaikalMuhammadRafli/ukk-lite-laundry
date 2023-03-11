<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Outlet;

class Package extends Model
{
    use HasFactory;

    protected $table = 'packages';

    protected $fillable = [
        'outlet_id',
        'category',
        'name',
        'price',
    ];

    public function outlet() {
        return $this->belongsTo(Outlet::class, 'outlet_id');
    }
}
