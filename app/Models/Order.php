<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class Order extends Model
{
    use HasFactory;

    protected $fillable =['order_number','total_order','user_id','address_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The orders that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('total_quantity', 'total_price');
    }

    /**
     * Get the address that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function address(): BelongsTo
    // {
    //     return $this->belongsTo(Address::class);
    // }

    /**
     * Get all of the adresses for the OrderAdress
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adresses(): HasMany
    {
        return $this->hasMany(OrderAdress::class);
    }
}
