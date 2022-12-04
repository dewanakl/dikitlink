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
        Schema::table('stats', function (Table $table) {
            $table->changeColumn(function ($table) {
                $table->text('user_agent');
                $table->string('ip_address');
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
        //
    }
};
