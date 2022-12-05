<?php

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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // $table->timestamp('created_at')->useCurrent();
            $table->string('title', 200);
            $table->string('slug', 200);
            $table->date('deadline')->nullable();
            $table->text('description');
            $table->enum('status', ['open', 'close', 'waiting']);
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('client_id'); 
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
