<?php
namespace App\Models;

use App\Models\Transaction;
use App\Models\Product; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionDetail extends Model
{

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    
    use HasFactory; // Jika Anda menggunakan factory

    protected $fillable = ['transaction_id', 'product_id', 'quantity', 'price'];

    // Relasi dengan Transaction
    

}
