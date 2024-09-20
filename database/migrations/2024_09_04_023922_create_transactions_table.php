<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->decimal('total_price', 15, 2);
        $table->timestamp('transaction_date');
        $table->timestamps();
    });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
