<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('x_menu', function (Blueprint $table) {
            $table->id();
            $table->string('kode_menu', 50);
            $table->string('nama_menu', 50);
            $table->boolean('is_active')->nullable()->default(false);
            $table->boolean('is_deleted')->nullable()->default(false);
            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('updated_by')->nullable();
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
        Schema::dropIfExists('x_menu');
    }
}
