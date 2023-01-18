<?php

namespace Core\Model;

use Closure;
use Core\Facades\App;
use Exception;

/**
 * Helper class DB untuk customizable nama table
 *
 * @class DB
 * @package \Core\Model
 */
final class DB
{
    /**
     * Nama tabelnya apah ?
     *
     * @param string $name
     * @return BaseModel
     */
    public static function table(string $name): BaseModel
    {
        $base = new BaseModel();
        $base->table($name);
        return $base;
    }

    /**
     * Mulai transaksinya
     *
     * @return bool
     */
    public static function beginTransaction(): bool
    {
        return App::get()->singleton(DataBase::class)->beginTransaction();
    }

    /**
     * Commit transaksinya
     *
     * @return bool
     */
    public static function commit(): bool
    {
        return App::get()->singleton(DataBase::class)->commit();
    }

    /**
     * Kembalikan transaksinya
     *
     * @return bool
     */
    public static function rollBack(): bool
    {
        return App::get()->singleton(DataBase::class)->rollBack();
    }

    /**
     * Tampilkan errornya
     *
     * @param mixed $e
     * @return void
     */
    public static function exception(mixed $e): void
    {
        App::get()->singleton(DataBase::class)->catchException($e);
    }

    /**
     * DB transaction sederhana
     *
     * @param Closure $fn
     * @return void
     */
    public static function transaction(Closure $fn): void
    {
        try {
            self::beginTransaction();
            $fn();
            self::commit();
        } catch (Exception $e) {
            self::rollBack();
            self::exception($e);
        }
    }
}
