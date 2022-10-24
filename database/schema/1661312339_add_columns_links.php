<?php

use Core\Database\Migration;
use Core\Database\Schema;
use Core\Database\Table;

return new class implements Migration
{
    /**
     * Jalankan migrasi
     *
     * @return void
     */
    public function up()
    {
        Schema::table('links', function (Table $table) {
            $table->addColumn(function () use ($table) {
                $table->string('link_password', 20)->nullable();
                $table->dateTime('waktu_buka')->nullable();
                $table->dateTime('waktu_tutup')->nullable();
            });
        });
    }

    /**
     * Kembalikan seperti semula
     *
     * @return void
     */
    public function down()
    {
        Schema::table('links', function (Table $table) {
            $table->dropColumn('link_password');
            $table->dropColumn('waktu_buka');
            $table->dropColumn('waktu_tutup');
        });
    }
};
