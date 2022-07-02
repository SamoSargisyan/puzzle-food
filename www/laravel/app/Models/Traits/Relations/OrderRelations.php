<?php

namespace App\Models\Traits\Relations;

use App\Models\User;

trait OrderRelations
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
