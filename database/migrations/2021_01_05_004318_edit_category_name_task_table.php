<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditCategoryNameTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task', function (Blueprint $table) {
            $table->string('classification')->comment('分類名稱')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task', function (Blueprint $table) {
            if (Schema::hasColumn('classification')) {
                $table->dropColumn('classification');
            }
        });
    }
}
