<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPreviewSecretAndLinksToPortfolioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portfolio', function (Blueprint $table) {
            $table->string('preview_secret');
            $table->json('url')->change();
            $table->renameColumn('url', 'links');

            \App\Models\Portfolio::each(function (App\Models\Portfolio $portfolio) {
                $portfolio->update([
                    'preview_secret' => \Illuminate\Support\Str::random(10),
                ]);
            });
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
            $table->dropColumn('preview_secret');
            $table->string('url')->change();
            $table->renameColumn('links', 'url');
        });
    }
}
