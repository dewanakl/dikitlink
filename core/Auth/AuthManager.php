<?php

namespace Core\Auth;

use Core\Model\BaseModel;
use Core\Facades\App;
use Core\Http\Session;
use Core\Valid\Hash;
use Exception;

/**
 * Autentikasi user dengan basemodel
 *
 * @class AuthManager
 * @package \Core\Auth
 */
class AuthManager
{
    /**
     * Object basemodel
     * 
     * @var BaseModel|null $user
     */
    private $user;

    /**
     * Object session
     * 
     * @var Session $session
     */
    private $session;

    /**
     * Init obejct
     * 
     * @param Session $session
     * @return void
     */
    function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * Check usernya
     * 
     * @return bool
     */
    public function check(): bool
    {
        $check = empty($this->user()) ? false : !empty($this->user->fail(fn () => false));
        if (!$check) {
            $this->logout();
        }

        return $check;
    }

    /**
     * Dapatkan id usernya
     * 
     * @return int|string|null
     */
    public function id(): int|string|null
    {
        return empty($this->user) ? null : $this->user->{$this->user->getPrimaryKey()};
    }

    /**
     * Dapatkan obejek usernya
     * 
     * @return BaseModel|null
     */
    public function user(): BaseModel|null
    {
        if (!($this->user instanceof BaseModel)) {
            $user = $this->session->get('_user');
            $this->user = empty($user) ? null : unserialize($user)->refresh();
        }

        return $this->user;
    }

    /**
     * Logoutkan usernya
     * 
     * @return void
     */
    public function logout(): void
    {
        $this->user = null;
        $this->session->unset('_user');
    }

    /**
     * Loginkan usernya dengan object
     * 
     * @param object $user
     * @return void
     * 
     * @throws Exception
     */
    public function login(object $user): void
    {
        if (!($user instanceof BaseModel)) {
            throw new Exception('Class ' . get_class($user) . ' bukan BaseModel !');
        }

        $this->logout();
        $this->user = $user->only([$user->getPrimaryKey()]);
        $this->session->set('_user', serialize($this->user));
    }

    /**
     * Loginkan usernya
     * 
     * @param array $credential
     * @param string $model
     * @return bool
     */
    public function attempt(array $credential, string $model = 'Models\User'): bool
    {
        list($first, $last) = array_keys($credential);

        $user = App::get()->singleton($model)->find($credential[$first], $first);
        $this->logout();

        if ($user->fail(fn () => false)) {
            if (Hash::check($credential[$last], $user->$last)) {
                $this->user = $user->only([$user->getPrimaryKey()]);
                $this->session->set('_user', serialize($this->user));
                return true;
            }
        }

        $this->session->set('old', [$first => $credential[$first]]);
        $this->session->set('error', [$first => $first . ' atau ' . $last . ' salah !']);
        return false;
    }
}
