<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('person_name');                 // nama orang / keterangan
            $table->decimal('amount', 15, 2);               // nominal total
            $table->decimal('paid_amount', 15, 2)->default(0); // sudah dibayar/diterima
            $table->enum('type', ['debt', 'receivable']);   // debt = saya berhutang, receivable = orang berhutang ke saya
            $table->date('due_date')->nullable();          // jatuh tempo (opsional)
            $table->text('description')->nullable();
            $table->boolean('is_paid')->default(false);     // lunas atau belum
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debts');
    }
};
