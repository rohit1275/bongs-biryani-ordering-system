<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['code', 'type', 'value', 'expiry_date', 'usage_limit', 'used_count'];

    protected function casts(): array
    {
        return [
            'expiry_date' => 'date',
        ];
    }
}
