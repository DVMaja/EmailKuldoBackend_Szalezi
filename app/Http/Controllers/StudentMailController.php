<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;
use App\Mail\StudentEmail;
use Illuminate\Support\Facades\DB;

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

    public function emailPdfel()
    {
        //$jsonFilePath = $mappa;//kuldestSegito -> itt lesz a json file ami a kiküldéshez kell
        $jsonFilePath = storage_path('app/kuldestSegito/studentEmailData_2023-12-08_08-46.json');

        if (file_exists($jsonFilePath)) {
            $jsonContent = file_get_contents($jsonFilePath);
            $emails = json_decode($jsonContent);
            $db = 0;
            foreach ($emails as $email) {
                $mailData = [
                    'student_id' => $email->student_id,
                    'name' => $email->nev,
                    'email' => $email->email,
                    'pdf_name' => $email->pdf_name,
                    'path' => $email->path, //"public/mappa"

                ];
                //print($mailData[$db]);
                //print($details['path']);
                Mail::to($email->email)->send(new StudentEmail($mailData)); //, $pdfAdatok

                $db += 1;
            }
            dd("Emails elküldve: ");
        } else {
            dd("JSON file not found");
        }
    }
}
