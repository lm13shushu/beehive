<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInitialMicroblogIdToMicroblogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('microblogs', function (Blueprint $table) {
            //
            $table->integer('initialMicroblog_Id')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('microblogs', function (Blueprint $table) {
            //
             $table->dropColumn('initialMicroblog_Id');
        });
    }
}
