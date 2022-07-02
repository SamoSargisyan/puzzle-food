<?php

namespace App\Models;

use App\Models\Traits\Relations\OrderRelations;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use OrderRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'user_id',
        'full_price',
        'address',
    ];
}
