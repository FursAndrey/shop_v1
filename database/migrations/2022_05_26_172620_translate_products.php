<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TranslateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('short_name', 'short_name_ru');
            $table->renameColumn('full_name', 'full_name_ru');
            $table->renameColumn('description', 'description_ru');
            $table->string('short_name_en', 10)->after('short_name');
            $table->string('full_name_en', 30)->after('full_name');
            $table->text('description_en')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('short_name_ru', 'short_name');
            $table->renameColumn('full_name_ru', 'full_name');
            $table->renameColumn('description_ru', 'description');
            $table->dropColumn('short_name_en');
            $table->dropColumn('full_name_en');
            $table->dropColumn('description_en');
        });
    }
}
