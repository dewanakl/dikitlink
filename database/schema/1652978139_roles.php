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
        Schema::create('roles', function (Table $table) {
            $table->id();
            $table->string('level');
        });
    }

    /**
     * Kembalikan seperti semula
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roles');
    }
};
