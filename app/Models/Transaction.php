<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['customer_id', 'date', 'day', 'amount'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
}
