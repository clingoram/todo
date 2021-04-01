<?php
// 測試用DB，該table對應todo的task
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodoTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_todo_task', function (Blueprint $table) {
            $table->id();
            $table->string('description')->comment('描述');
            $table->string('status')->comment('狀態，已完成1;未完成2、刪除0')->default(2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_todo_task');
    }
}
