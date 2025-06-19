<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('submissions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('assignment_id')
            ->constrained()
            ->onDelete('cascade');
        $table->foreignId('mentee_id')
            ->constrained('users')
            ->onDelete('cascade');

        $table->text('answer')->nullable();
        $table->string('file_path')->nullable();
        $table->timestamp('submitted_at')->nullable();
        $table->integer('grade')->nullable();
        $table->text('feedback')->nullable();
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
