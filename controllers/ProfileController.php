<?php

namespace Controllers;

use Core\Auth\Auth;
use Core\Http\Request;
use Core\Routing\Controller;
use Core\Support\Mail;
use Core\Valid\Hash;
use Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return $this->view('profile');
    }

    public function update(Request $request)
    {
        $credential = $request->validate([
            'nama' => ['required', 'trim', 'str', 'min:2', 'max:20'],
        ]);

        if (!auth()->user()->email_verify) {
            $request->validate([
                'email' => ['required', 'trim', 'email', 'dns', 'str', 'min:5', 'max:50'],
            ]);

            $email = User::where('email', $request->email)
                ->where('id', Auth::user()->id, '!=')
                ->limit(1)
                ->first();

            if ($email->email) {
                $request->throw([
                    'email' => 'email sudah ada'
                ]);
            }

            $credential['email'] = $request->email;
        }

        if (empty($request->password) && !empty($request->konfirmasi_password)) {
            $request->validate([
                'password' => ['required'],
            ]);
        }

        if (!empty($request->password) && empty($request->konfirmasi_password)) {
            $request->validate([
                'konfirmasi_password' => ['required'],
            ]);
        }

        if (!empty($request->password) && !empty($request->konfirmasi_password)) {
            $request->validate([
                'password' => ['trim', 'str', 'min:8', 'max:20'],
                'konfirmasi_password' => ['trim', 'str', 'min:8', 'max:20', 'sama:password', 'hash']
            ]);

            $credential['password'] = $request->konfirmasi_password;
        }

        User::where('id', Auth::user()->id)->update($credential);

        return $this->back()->with('berhasil', 'Berhasil mengupdate profil');
    }

    public function email(Mail $mail)
    {
        $key = Hash::rand(30);

        $mail->addTo(auth()->user()->email)
            ->subjek('Verify Email Dikit Link')
            ->pesan($this->view('email/verify', [
                'nama' => auth()->user()->nama,
                'link' => route('verify', $key)
            ]));

        session()->unset('key');

        if ($mail->send()) {
            session()->set('key', $key);
            return $this->back()->with('berhasil', 'Cek email, termasuk di folder spam');
        }

        return $this->back()->with('gagal', 'Gagal mengirim email');
    }

    public function verify($id)
    {
        $success = false;

        if (hash_equals(session()->get('key', Hash::rand(10)), $id)) {
            $user = User::find(auth()->user()->id);
            $user->email_verify = true;
            $user->save();

            $success = true;
        }

        session()->unset('key');

        if ($success) {
            return $this->redirect(route('profile'))->with('berhasil', 'Email terverifikasi');
        }

        return $this->redirect(route('profile'))->with('gagal', 'Kode tidak valid !');
    }
}
