<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', static function (Blueprint $table) {
            $table->id(); // Big int
            $table->string('name')->nullable();
            $table->bigInteger('count')->default(0);
            $table->timestamp('last_time_on_menu')->nullable();

            $table->text('ingredients')->nullable();
            $table->text('preperation')->nullable();
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->boolean('is_vegetarian')->default(false);
            $table->boolean('is_low_carb')->default(false);
            $table->integer('calories')->nullable();
            $table->integer('carbs')->nullable();
            $table->integer('fats')->nullable();
            $table->integer('proteins')->nullable();

            $table->unsignedBigInteger('cookbook_id')->nullable();
            $table->foreign('cookbook_id')->references('id')->on('cookbooks')->onDelete('set null');

            $table->unsignedBigInteger('mealtype_id')->nullable();
            $table->foreign('mealtype_id')->references('id')->on('mealtypes')->onDelete('set null');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
            //$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meals');
    }
}
