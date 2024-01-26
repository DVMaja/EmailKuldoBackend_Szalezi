<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;
use App\Mail\StudentEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $jsonFilePath = storage_path('app/jsonScriptek/studentEmailData_2024-01-26_15-54.json');

        if (file_exists($jsonFilePath)) {
            $jsonContent = file_get_contents($jsonFilePath);

            $emails = json_decode($jsonContent);
            $db = 0;
            foreach ($emails as $email) {
                $mailData = [
                    'student_id' => $email->student_id,
                    'name' => $email->nev,
                    'email' => $email->email,
                    'pdf_name' => $email->pdf_name . '.pdf',
                    'path' => 'storage/kuldendoFajlok' //$email->path, //'storage/kuldendoFajlok'

                ];
                //print($mailData['name']);
                //toth.laszlo@akkszalezi.hu
                Mail::to($email->email)->send(new StudentEmail($mailData)); //, $pdfAdatok

                $db += 1;
            }
            dd("Emails elküldve: ");
        } else {
            dd("JSON file not found");
        }
    }

    public function mailDatasJsonba()
    {
        $students = DB::table('mail_senders')
            ->select('student_id', 'nev', 'email', 'pdf_name') //, 'p.path'
            ->get();

        //print($students);
        $timestamp = now()->format('Y-m-d_H-i');
        $jsonFileName = 'studentEmailData_' . $timestamp . '.json';

        $jsonContent = json_encode($students);
        Storage::put('/jsonScriptek/' . $jsonFileName, $jsonContent);

        return $students;
    }
}
