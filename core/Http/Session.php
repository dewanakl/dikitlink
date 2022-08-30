<?php

namespace Core\Http;

use Core\Valid\Hash;

/**
 * Handle session
 *
 * @class Session
 * @package Core\Http
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
        $this->name = env('APP_NAME', 'kamu') . '_session';

        if (@$_COOKIE[$this->name]) {
            $this->data = unserialize(Hash::decrypt(rawurldecode($_COOKIE[$this->name])));
        }

        if (is_null($this->get('_token'))) {
            $this->set('_token', Hash::rand(16));
        }
    }

    /**
     * Send cookie header
     *
     * @return void
     */
    public function send(): void
    {
        $expires = env('COOKIE_LIFETIME', 86400) + time();
        $header = 'Set-Cookie: ' . $this->name . '=' . rawurlencode(Hash::encrypt(serialize($this->data)));

        $header .= '; expires=' . date('D, d-M-Y H:i:s', $expires) . ' GMT' . '; Max-Age=' . ($expires - time());
        $header .= '; path=/';

        if (HTTPS) {
            $header .= '; secure';
        }

        $header .= '; httponly';
        $header .= '; samesite=strict';

        header($header);
    }

    /**
     * Ambil nilai dari sesi ini
     *
     * @param ?string $name
     * @param mixed $defaultValue
     * @return mixed
     */
    public function get(?string $name = null, mixed $defaultValue = null): mixed
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
