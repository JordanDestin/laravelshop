<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAdress extends Model
{
    use HasFactory;

    protected $fillable = ['address','addressbis','postal','city','order_id'];

    
}
