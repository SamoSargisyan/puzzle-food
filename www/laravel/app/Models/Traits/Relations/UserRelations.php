<?php

namespace App\Models\Traits\Relations;

use App\Models\Order;

trait UserRelations
{
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
