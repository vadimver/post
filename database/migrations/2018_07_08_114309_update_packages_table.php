<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->integer('start_office_id')->unsigned()->nullable()->after('consign_id');
            $table->integer('finish_office_id')->unsigned()->nullable()->after('start_office_id');
            
            $table->foreign('start_office_id')
                    ->references('number')->on('offices')
                    ->onDelete('cascade');
            
            $table->foreign('finish_office_id')
                    ->references('number')->on('offices')
                    ->onDelete('cascade');
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
    }
}
