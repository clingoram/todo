<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategorynameTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task', function (Blueprint $table) {
            $table->string('classification')->comment('分類名稱');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('classification')) {
            Schema::table('task', function (Blueprint $table) {
                $table->dropColumn('classification');
            });
        };
    }
}
