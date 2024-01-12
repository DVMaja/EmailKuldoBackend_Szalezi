<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;
use App\Mail\StudentEmail;

class StudentMailController extends Controller
{
    public function index()
    {
        $mailData = [
            'name' => 'Üzenet fogadó',

        ];

        Mail::to('athena.noctua.1769@gmail.com')
            ->send(new StudentEmail($mailData));

        dd("Email is sent successfully.");
    }
}
