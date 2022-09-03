<?php

namespace Controllers;

use Core\Auth\Auth;
use Core\Http\Request;
use Core\Routing\Controller;
use Core\Support\Mail;
use Core\Valid\Hash;
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

    public function forget()
    {
        return $this->view('auth/forget');
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
            'nama' => ['required', 'trim', 'str', 'min:2', 'max:20'],
            'email' => ['required', 'trim', 'email', 'str', 'min:5', 'max:50', 'unik'],
            'password' => ['required', 'trim', 'str', 'min:8', 'max:20', 'hash']
        ]);

        $credential['role_id'] = 2;
        User::create($credential);

        return $this->redirect(route('login'))->with('berhasil', 'Berhasil registrasi, silahkan login');
    }

    public function send(Request $request, Mail $mail)
    {
        $request->validate([
            'email' => ['required', 'trim', 'email', 'str', 'min:5', 'max:50']
        ]);

        $user = User::find($request->email, 'email')->fail(fn () => false);

        if (!$user) {
            return $this->back()->with('gagal', 'Email tidak ada');
        }

        $key = Hash::rand(30);

        $mail->addTo($request->email)
            ->subjek('Reset Password Dikit Link')
            ->pesan(
                $this->view('/../helpers/templates/templateMail', [
                    'nama' => $user->nama,
                    'link' => route('reset', $key)
                ])
            );

        if ($mail->send()) {
            session()->set('key', $key);
            session()->set('email', $request->email);

            return $this->back()->with('berhasil', 'Cek email, termasuk di folder spam');
        }

        return $this->back()->with('gagal', 'Gagal mengirim email');
    }

    public function reset($id)
    {
        if ($id === session()->get('key')) {
            Auth::login(User::find(session()->get('email'), 'email'));
            session()->unset('key');
            session()->unset('email');

            return $this->redirect(route('profile'))->with('berhasil', 'Silahkan ganti password anda !');
        }

        session()->unset('key');
        session()->unset('email');

        return $this->redirect(route('login'))->with('gagal', 'Kode tidak valid !');
    }
}
