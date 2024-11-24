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
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->enum('priority', ['haute', 'moyenne', 'basse']);
        $table->date('due_date');
        $table->enum('status', ['ouverte', 'terminee'])->default('ouverte');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}

};
$table->foreignId('user_id')->constrained()->onDelete('cascade');

