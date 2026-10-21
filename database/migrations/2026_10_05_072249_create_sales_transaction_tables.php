<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Guard: jangan buat ulang kalau sudah dibuat di materi CRUD Items
        if (!Schema::hasTable('items')) {
            Schema::create('items', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description')->nullable();
                $table->decimal('price', 12, 2);
                $table->integer('stock');
                $table->timestamps();
            });
        }

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->date('transaction_date');
            $table->decimal('subtotal', 12, 2);                       // sebelum diskon
            $table->decimal('discount_percent', 5, 2)->default(0);    // Fitur 1: diskon (%)
            $table->decimal('discount_amount', 12, 2)->default(0);    // Fitur 1: nilai diskon (Rp)
            $table->decimal('total_amount', 12, 2);                   // total bayar setelah diskon
            $table->timestamps();
        });

        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->cascadeOnDelete();
            $table->foreignId('item_id')->constrained();
            $table->decimal('price', 12, 2);
            $table->integer('quantity');
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('items');
    }
};