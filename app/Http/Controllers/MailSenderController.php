<?php

namespace App\Http\Controllers;

use App\Models\MailSender;
use Illuminate\Http\Request;

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
        $mailSender->student_id = $request->student_id;
        $mailSender->pdf_name = $request->pdf_name;
        $mailSender->path = $request->path;
        $mailSender->save();
    }

    public function store(Request $request)
    {
        $mailSender = new MailSender();
        $mailSender->student_id = $request->student_id;
        $mailSender->pdf_name = $request->pdf_name;
        $mailSender->path = $request->path;
        $mailSender->save();
    }
}
