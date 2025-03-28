<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects', 'id');
            $table->string('name');
            $table->text('description');
            $table->string('status')->default('to_do');
            $table->string('priority')->default('low');
            $table->dateTime('due_date')->nullable();
            $table->foreignId('created_by')->constrained('users', 'id');
            $table->foreignId('assigned_to')->nullable()->constrained('users', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
