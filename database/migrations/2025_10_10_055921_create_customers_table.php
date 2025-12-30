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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_type_id')->constrained();
            $table->string('document_number', 30)->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['M', 'F', 'O']);
            $table->date('birth_date');
            $table->string('phone', 20);
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
