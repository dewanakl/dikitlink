<?php

namespace Core\Database;

use Closure;
use Core\Facades\App;

/**
 * Helper class untuk skema tabel
 *
 * @class Schema
 * @package \Core\Database
 */
final class Schema
{
    /**
     * Bikin tabel baru
     *
     * @param string $name
     * @param Closure $attribute
     * @return void
     */
    public static function create(string $name, Closure $attribute): void
    {
        $table = App::get()->singleton(Table::class);
        $table->table($name);
        App::get()->resolve($attribute);

        App::get()->singleton(DataBase::class)->exec($table->create());
    }

    /**
     * Ubah attribute tabelnya
     *
     * @param string $name
     * @param Closure $attribute
     * @return void
     */
    public static function table(string $name, Closure $attribute): void
    {
        $table = App::get()->singleton(Table::class);
        $table->table($name);
        App::get()->resolve($attribute);

        $export = $table->export();
        if ($export) {
            App::get()->singleton(DataBase::class)->exec($export);
        }
    }

    /**
     * Hapus tabel
     *
     * @param string $name
     * @return void
     */
    public static function drop(string $name): void
    {
        App::get()->singleton(DataBase::class)->exec('DROP TABLE IF EXISTS ' . $name . ';');
    }

    /**
     * Rename tabelnya
     *
     * @param string $from
     * @param string $to
     * @return void
     */
    public static function rename(string $from, string $to): void
    {
        App::get()->singleton(DataBase::class)->exec('ALTER TABLE ' . $from . ' RENAME TO ' . $to . ';');
    }
}
