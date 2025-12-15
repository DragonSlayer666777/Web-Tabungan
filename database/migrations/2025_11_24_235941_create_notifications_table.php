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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
            $table->string('title');                    // judul notif
            $table->text('message');                    // isi pesan
            $table->string('type')->default('info');    // info, warning, success, reminder, dll
            $table->boolean('is_read')->default(false); // sudah dibaca atau belum
            
            $table->json('data')->nullable();           // optional: simpan data tambahan (contoh: debt_id, saving_id)
            
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
