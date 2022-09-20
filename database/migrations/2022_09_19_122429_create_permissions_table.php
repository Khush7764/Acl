<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('menu_name');
            $table->string('operation')->nullable();
            $table->string('uri')->nullable();
            $table->integer('parent_menu_id')->nullable();
            $table->integer('dependent_menu_id')->nullable();
            $table->enum('menu_type', ['sidebar', 'tab', 'singular'])->default('sidebar');
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
        Schema::dropIfExists('permissions');
    }
}
