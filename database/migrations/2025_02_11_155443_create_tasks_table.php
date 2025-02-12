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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title', 30);
            $table->enum('status', ['Pendente', 'Concluída'])->default('Pendente');
            $table->enum('category', ['Trabalho', 'Pessoal', 'Estudos'])->default('Trabalho');
            $table->date('deadline');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    
        Schema::dropIfExists('tasks');
    }
};
