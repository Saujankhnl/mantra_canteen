<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'email', 'qr_token', 'balance'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
