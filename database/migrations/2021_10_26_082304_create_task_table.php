<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            $table->string('description')->comment('描述');
            $table->boolean('status')->comment('狀態，已完成true;未完成false')->default(false);
            $table->timestamp('end_at', 0)->comment('結束時間');
            $table->string('classification')->comment('分類名稱');
            $table->softDeletes();
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
        // Schema::dropIfExists('task');
        if (Schema::hasTable('task')) {
            Schema::drop('task');
        }
    }
}
