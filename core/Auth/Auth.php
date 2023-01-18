<?php

namespace Core\Auth;

use Core\Facades\App;

/**
 * Helper class Autentikasi
 * 
 * @method static bool check()
 * @method static int|null id()
 * @method static \Core\Model\BaseModel|null user()
 * @method static void logout()
 * @method static void login(object $user)
 * @method static bool attempt(array $credential, string $model = 'Models\User')
 * 
 * @see \Core\Auth\AuthManager
 *
 * @class Auth
 * @package \Core\Auth
 */
final class Auth
{
    /**
     * Panggil method secara static
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public static function __callStatic(string $method, array $parameters): mixed
    {
        return App::get()->singleton(self::class)->__call($method, $parameters);
    }

    /**
     * Panggil method secara object
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function __call(string $method, array $parameters): mixed
    {
        return App::get()->invoke(AuthManager::class, $method, $parameters);
    }
}
