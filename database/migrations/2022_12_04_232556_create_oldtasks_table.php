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
        Schema::create('oldtasks', function (Blueprint $table) {
            $table->string('task_id');
            $table->timestamp('now');
            $table->string('title', 200);
            $table->text('description');
            $table->enum('status', ['open', 'close']);
            $table->enum('priority', ['1 - low', '2 - medium', '3- hight']);
            $table->string('user_id'); 
            $table->string('client_id'); 
            $table->string('project_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oldtasks');
    }
};
