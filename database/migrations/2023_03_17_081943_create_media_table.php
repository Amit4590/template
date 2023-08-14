<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->integer('attr_id');
            $table->string('host_url')->nullable();
            $table->string('folder_name')->nullable();
            $table->string('image_name')->nullable();
            $table->string('image_type')->nullable();
            $table->string('type')->comment('1 => category , 2 => subcategory , 3 => book'); 
            $table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->tinyInteger('is_active')->default('1')->comment('1 => active , 0 => inactive');
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media');
    }
}
