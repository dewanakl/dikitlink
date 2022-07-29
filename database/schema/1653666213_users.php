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
        Schema::create('users', function (Table $table) {
            $table->id();
            $table->unsignedInteger('role_id');

            $table->string('nama', 50);
            $table->string('email', 100)->unique();
            $table->string('password');

            $table->timeStamp();

            $table->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete();
        });
    }

    /**
     * Kembalikan seperti semula
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
};
