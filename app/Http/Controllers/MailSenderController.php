<?php

namespace App\Http\Controllers;

use App\Models\MailSender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MailSenderController extends Controller
{
    public function index()
    {
        return MailSender::all();
    }

    public function show($id)
    {
        return MailSender::find($id);
    }

    public function destroy($id)
    {
        MailSender::find($id)->delete();
    }

    public function update(Request $request, $id)
    {
        $mailSender = MailSender::find($id);
        $mailSender->kod = $request->kod;
        $mailSender->fajlNev = $request->fajlNev;
        //$mailSender->path = $request->path;
        $mailSender->save();
    }

    public function store(Request $request)
    {        
        $mailSender = new MailSender();
        $mailSender->kod = $request->kod;
        $mailSender->fajlNev = $request->fajlNev;
        $mailSender->save();
    }

    public function mailSenderJsonba()
    {
        $mailSenderData = DB::table('mail_senders as m')
            ->join('students as s', 'm.student_id', '=', 's.student_id')
            ->select('m.kod', 'm.pdf_name', 'm.path', 's.email', 's.nev')
            ->get();

        /*  $timestamp = now()->format('Y-m-d_H-i');
        $jsonFileName = 'studentEmailData_' . $timestamp . '.json';

        $jsonContent = json_encode($mailSenderData);
        Storage::put('/jsonTarolo/' . $jsonFileName, $jsonContent); */
        return $mailSenderData;
    }
}
