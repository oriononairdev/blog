<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPortfolioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portfolio', function (Blueprint $table) {
            $table->json('type')
                ->after('id')
                ->nullable();
            $table->json('summary')
                ->after('title')
                ->nullable();
            $table->boolean('is_pinned')
                ->after('slug')
                ->default(0);
            $table->boolean('is_published')
                ->after('is_pinned')
                ->default(1);
            $table->string('color')
                ->after('is_published')
                ->default('#f16563');
            $table->string('url', 255)
                ->after('color')
                ->nullable();

            $table->json('title')->change();
            $table->json('description')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('portfolio', function (Blueprint $table) {
            $table->dropColumn('type', 'summary', 'is_pinned', 'is_published', 'color', 'url');
            $table->text('title')->change();
            $table->text('description')->change();
        });
    }
}
