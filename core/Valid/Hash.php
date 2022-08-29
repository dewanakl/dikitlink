<?php

namespace Core\Valid;

class Hash
{
    public const CIPHERING = 'AES-128-CTR';

    public static function encrypt(string $str): string
    {
        $app = explode('.', env('APP_KEY'));
        return openssl_encrypt($str, self::CIPHERING, $app[0], 0, $app[1]);
    }

    public static function decrypt(string $str): string
    {
        $app = explode('.', env('APP_KEY'));
        return openssl_decrypt($str, self::CIPHERING, $app[0], 0, $app[1]);
    }

    public static function make(string $value): string
    {
        return password_hash($value, PASSWORD_BCRYPT);
    }

    public static function check(string $value, string $hashedValue): bool
    {
        return password_verify($value, $hashedValue);
    }

    public static function rand(int $len): string
    {
        return bin2hex(random_bytes($len));
    }
}
