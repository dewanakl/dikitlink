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
        Schema::create('stats', function (Table $table) {
            $table->id();
            $table->unsignedInteger('link_id');

            $table->string('user_agent', 150);
            $table->string('ip_address', 20);

            $table->timeStamp();

            $table->foreign('link_id')->references('id')->on('links')->cascadeOnDelete();
        });
    }

    /**
     * Kembalikan seperti semula
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stats');
    }
};
