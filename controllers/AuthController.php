<?php

namespace Controllers;

use Core\Auth;
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
        Auth::logout();
        return $this->redirect(route('login'))->with('berhasil', 'Berhasil logout');
    }

    public function auth(Request $request)
    {
        $credential = $request->validate([
            'email' => ['required', 'trim', 'email', 'str', 'min:5', 'max:50'],
            'password' => ['required', 'trim', 'str', 'min:8', 'max:20']
        ]);

        if (Auth::attempt($credential)) {
            return $this->redirect(route('dashboard'));
        }

        return $this->back();
    }

    public function submit(Request $request)
    {
        $credential = $request->validate([
            'nama' => ['required', 'trim', 'str', 'min:2', 'max:25'],
            'email' => ['required', 'trim', 'email', 'str', 'min:5', 'max:50', 'unik'],
            'password' => ['required', 'trim', 'str', 'min:8', 'max:20', 'hash']
        ]);

        $credential['role_id'] = 2;
        User::create($credential);

        return $this->redirect(route('login'))->with('berhasil', 'Berhasil registrasi, silahkan login');
    }
}
