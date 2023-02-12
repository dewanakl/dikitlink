<?php

use Core\Database\Migration;
use Core\Database\Schema;
use Core\Database\Table;

return new class implements Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('links', function (Table $table) {
            $table->addColumn(function ($table) {

                $table->boolean('query_param')->default(false);
            });
        });
    }

    /**
     * Kembalikan seperti semula.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('links', function (Table $table) {
            $table->dropColumn('query_param');
        });
    }
};
