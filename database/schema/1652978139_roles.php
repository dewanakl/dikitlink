<?php

use Core\Schema;
use Core\Table;

return new class
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
