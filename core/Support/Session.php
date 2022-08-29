<?php

namespace Core\Support;

use Core\Valid\Hash;

/**
 * Class untuk menghandle session
 *
 * @class Session
 * @package Core\Support
 */
class Session
{
    /**
     * Data session
     * 
     * @var array $data
     */
    private array $data = [];

    /**
     * Name session
     * 
     * @var string $name
     */
    private $name;

    /**
     * Buat objek session
     *
     * @return void
     */
    function __construct()
    {
        $this->name = env('APP_NAME', 'Kamu');

        if (@$_COOKIE[$this->name]) {
            $this->data = unserialize(Hash::decrypt(rawurldecode($_COOKIE[$this->name])));
        }

        if (is_null($this->get('token'))) {
            $this->set('token', Hash::rand(10));
        }
    }

    /**
     * Send cookie header
     *
     * @return void
     */
    public function send(): void
    {
        $value = rawurlencode(Hash::encrypt(serialize($this->data)));
        $expires = env('COOKIE_LIFETIME', 86400) + time();
        $path = '/';

        $date = date('D, d-M-Y H:i:s', $expires) . ' GMT';
        $header = "Set-Cookie: {$this->name}={$value}";

        if ($expires != 0) {
            $header .= "; expires={$date}; Max-Age=" . ($expires - time());
        }

        if ($path != '') {
            $header .= '; path="' . $path . '"';
        }

        if (HTTPS) {
            $header .= '; secure';
        }

        if (true) {
            $header .= '; HttpOnly';
        }

        $header .= '; samesite=strict';

        header($header);
    }

    /**
     * Ambil nilai dari sesi ini
     *
     * @param string $name
     * @param mixed $defaultValue
     * @return mixed
     */
    public function get(string $name = null, mixed $defaultValue = null): mixed
    {
        if ($name === null) {
            return $this->data;
        }

        return $this->__get($name) ?? $defaultValue;
    }

    /**
     * Isi nilai ke sesi ini
     *
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function set(string $name, mixed $value): void
    {
        $this->data[$name] = $value;
    }

    /**
     * Hapus nilai dari sesi ini
     *
     * @param string $name
     * @return void
     */
    public function unset(string $name): void
    {
        unset($this->data[$name]);
    }

    /**
     * Ambil nilai dari sesi ini
     *
     * @param string $name
     * @return mixed
     */
    public function __get(string $name): mixed
    {
        return $this->__isset($name) ? $this->data[$name] : null;
    }

    /**
     * Cek nilai dari sesi ini
     *
     * @param string $name
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return isset($this->data[$name]);
    }
}
