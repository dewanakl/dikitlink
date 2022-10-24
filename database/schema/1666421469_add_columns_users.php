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
        Schema::table('users', function (Table $table) {
            $table->addColumn(function ($table) {
                $table->boolean('statistics')->default(true);
                $table->dateTime('last_active')->nullable();
                $table->boolean('email_verify')->nullable();
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
        Schema::table('users', function (Table $table) {
            $table->dropColumn('statistics');
            $table->dropColumn('last_active');
            $table->dropColumn('email_verify');
        });
    }
};
