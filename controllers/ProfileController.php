<?php

namespace Controllers;

use Core\Auth\Auth;
use Core\Database\DB;
use Core\Http\Request;
use Core\Routing\Controller;
use Core\Support\Mail;
use Core\Valid\Hash;
use Models\Log;
use Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return $this->view('profile');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'mypassword' => ['required', 'str', 'slug', 'min:8', 'max:25']
        ]);

        if (Hash::check($request->mypassword, Auth::user()->password)) {
            User::destroy(Auth::id());
            return $this->redirect(route('login'))->with('berhasil', 'Berhasil menghapus akun !');
        }

        return $this->redirect(route('profile'))->with('gagal', 'Password salah !');
    }

    public function statistik(Request $request)
    {
        $valid = $this->validate($request, [
            'check' => ['bool']
        ]);

        if ($valid->fails()) {
            return json([
                'error' => $valid->failed()
            ], 400);
        }

        return json([
            'status' => DB::table('users')
                ->where('id', Auth::id())
                ->update([
                    'statistics' => $valid->check
                ])
        ]);
    }

    public function update(Request $request)
    {
        $credential = $request->validate([
            'nama' => ['required', 'str', 'trim', 'min:2', 'max:25'],
        ]);

        if (!auth()->user()->email_verify) {
            $request->validate([
                'email' => ['required', 'str', 'trim', 'min:5', 'max:100', 'email', 'dns'],
            ]);

            $email = User::where('email', $request->email)
                ->where('id', auth()->id(), '!=')
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
                'password' => ['str', 'trim', 'min:8', 'max:25'],
                'konfirmasi_password' => ['str', 'trim', 'min:8', 'max:25', 'sama:password', 'hash']
            ]);

            $credential['password'] = $request->konfirmasi_password;
        }

        User::id(Auth::id())->update($credential);

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
            $user = User::find(Auth::id());
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

    public function avatar()
    {
        header('Content-Type: image/svg+xml');
        respond()->terminate($this->view('avatar/avatar', [
            'nama' => implode(array_map(fn ($name) => $name[0], explode(' ', Auth::user()->nama)))
        ]));
    }

    public function log()
    {
        return json(
            Log::where('user_id', Auth::id())
                ->orderBy('id', 'DESC')
                ->select([
                    'created_at',
                    'ip_address',
                    'user_agent'
                ])
                ->get()
        );
    }
}
