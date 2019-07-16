<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('guid')->unique();
            $table->string('slug')->unique();

            $table->unsignedInteger('account_id')->nullable()->comment('FK to [stubclients]');
            //$table->foreign('stubclient_id')->references('id')->on('stubclients');

            $table->string('wname', 63);
            $table->string('wstate', 63)->nullable();
            $table->text('description')->nullable();

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
        Schema::dropIfExists('widgets');
    }
}
