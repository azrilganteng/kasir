<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'stock'];

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'transaction_details')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

}
