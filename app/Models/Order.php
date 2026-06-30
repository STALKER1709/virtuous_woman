<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function markPaid(): void
    {
        $this->payment_status = 'paid';

        if ($this->status === 'pending') {
            $this->status = 'processing';
        }

        $this->save();
    }
}
