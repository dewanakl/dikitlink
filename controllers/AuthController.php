<?php

namespace Controllers;

use Core\Controller;
use Core\Request;
use Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return $this->view('auth/login');
    }

    public function register()
    {
        return $this->view('auth/register');
    }

    public function logout()
    {
        auth()->logout();
        return $this->redirect(route('login'))->with('berhasil', 'Berhasil Logout');
    }

    public function auth(Request $request)
    {
        $credential = $request->validate([
            'email' => ['required', 'email', 'str', 'min:5', 'max:50'],
            'password' => ['required', 'str', 'min:5', 'max:20']
        ]);

        if (auth()->attempt($credential)) {
            return $this->redirect(route('dashboard'));
        }

        return $this->back();
    }

    public function submit(Request $request)
    {
        $credential = $request->validate([
            'nama' => ['required', 'str', 'min:2', 'max:50'],
            'email' => ['required', 'email', 'str', 'min:5', 'max:50', 'unik'],
            'password' => ['required', 'str', 'min:5', 'max:20', 'hash']
        ]);

        $credential['role_id'] = 2;
        User::create($credential);

        return $this->redirect(route('login'))->with('berhasil', 'Berhasil membuat akun, silahkan login');
    }
}
