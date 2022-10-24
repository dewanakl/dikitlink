<?php

namespace Core\Database;

use Closure;
use Exception;

/**
 * Helper class DB untuk custome nama table
 *
 * @class DB
 * @package Core\Database
 */
final class DB
{
    /**
     * Simpan jadi objek tunggal
     * 
     * @var BaseModel $base
     */
    private static $base;

    /**
     * Nama tabelnya apah ?
     *
     * @param string $name
     * @return BaseModel
     */
    public static function table(string $name): BaseModel
    {
        if (!(self::$base instanceof BaseModel)) {
            self::$base = new BaseModel();
        }

        self::$base->table($name);
        return self::$base;
    }

    /**
     * Mulai transaksinya
     *
     * @return bool
     */
    public static function beginTransaction(): bool
    {
        self::$base = new BaseModel();
        return self::$base->db()->beginTransaction();
    }

    /**
     * Commit transaksinya
     *
     * @return bool
     */
    public static function commit(): bool
    {
        return self::$base->db()->commit();
    }

    /**
     * Kembalikan transaksinya
     *
     * @return bool
     */
    public static function rollBack(): bool
    {
        return self::$base->db()->rollBack();
    }

    /**
     * Tampilkan errornya
     *
     * @return void
     */
    public static function exception(mixed $e): void
    {
        self::$base->db()->catchException($e);
    }

    /**
     * DB transaction sederhana
     *
     * @return void
     */
    public static function transaction(Closure $fn): void
    {
        self::beginTransaction();
        try {
            $fn();
            self::commit();
        } catch (Exception $e) {
            self::rollBack();
            self::exception($e);
        }
    }
}
