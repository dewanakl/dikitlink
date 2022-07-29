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
        Schema::create('links', function (Table $table) {
            $table->id();
            $table->unsignedInteger('user_id');

            $table->string('name')->unique();
            $table->text('link');

            $table->timeStamp();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Kembalikan seperti semula
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('links');
    }
};
