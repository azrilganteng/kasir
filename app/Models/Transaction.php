<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    use HasFactory;

    // Tentukan kolom yang dapat diisi
    protected $fillable = ['total_price', 'transaction_date'];

    // Relasi dengan produk
    public function products()
    {
        return $this->belongsToMany(Product::class, 'transaction_details')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

    // Tentukan format date untuk transaction_date
    protected $dates = ['transaction_date'];

    // Override created_at untuk otomatis diisi dengan transaction_date
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->transaction_date)) {
                $model->transaction_date = $model->freshTimestamp(); // Isi transaction_date saat transaksi dibuat
            }
        });
    }
}
