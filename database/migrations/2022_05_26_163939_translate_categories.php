<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TranslateCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->renameColumn('name', 'name_ru');
            $table->renameColumn('description', 'description_ru');
            $table->string('name_en', 30)->after('name');
            $table->text('description_en')->nullable('description')->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->renameColumn('name_ru', 'name');
            $table->renameColumn('description_ru', 'description');
            $table->dropColumn('name_en');
            $table->dropColumn('description_en');
        });
    }
}
