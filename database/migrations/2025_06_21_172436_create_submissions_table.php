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
    Schema::create('submissions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('assignment_id')->constrained()->onDelete('cascade');
        $table->foreignId('mentee_id')->constrained('users')->onDelete('cascade');
        $table->string('file'); // jawaban mentee
        $table->text('feedback')->nullable(); // komentar dari mentor
        $table->integer('score')->nullable(); // nilai
        $table->timestamp('submitted_at')->nullable(); // kapan dikumpulkan
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
