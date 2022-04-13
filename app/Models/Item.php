<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'qty', 'brand', 'selling_price', 'buying_price', 'profit_margin', 'warranty', 'expiry_date', 'status'];
}
