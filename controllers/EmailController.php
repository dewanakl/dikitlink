<?php

namespace Controllers;

use Core\Routing\Controller;
use Core\Http\Request;
use Core\Support\Mail;

class EmailController extends Controller
{
    public function index(Mail $mail)
    {
        $mail->addTo(auth()->user()->email)
            ->subjek('Reset Password Dikit Link')
            ->pesan(
                $this->view('/../helpers/templates/templateMail', [
                    'namaEmail' => auth()->user()->email
                ])
            );

        return $mail->send();
    }
}
