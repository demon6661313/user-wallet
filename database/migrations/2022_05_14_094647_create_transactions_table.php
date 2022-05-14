<?php

use App\Models\Transaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('wallet_id')->references('id')->on('wallets')->cascadeOnDelete();
            $table->enum('type', [Transaction::TYPE_DEBIT, Transaction::TYPE_CREDIT]);
            $table->decimal('value', 9, 2, true);
            $table->enum('reason', [Transaction::REASON_STOCK, Transaction::REASON_REFUND]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
