<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\LazyCollection;

class StudentController extends Controller
{
    public function index()
    {
        return Student::all();
    }

    public function show($id)
    {
        return Student::find($id);
    }

    public function destroy($id)
    {
        Student::find($id)->delete();
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        $student->adoszam = $request->adoszam;
        $student->tajszam = $request->tajszam;
        $student->email = $request->email;
        $student->nev = $request->nev;
        $student->szul_nev = $request->szul_nev;
        $student->anyja_neve = $request->anyja_neve;
        $student->okt_azon = $request->okt_azon;
        $student->major_id = $request->major_id;
        $student->save();
    }

    public function store(Request $request)
    {
        $student = new Student();
        $student->adoszam = $request->adoszam;
        $student->tajszam = $request->tajszam;
        $student->email = $request->email;
        $student->nev = $request->nev;
        $student->szul_nev = $request->szul_nev;
        $student->anyja_neve = $request->anyja_neve;
        $student->okt_azon = $request->okt_azon;
        $student->major_id = $request->major_id;
        $student->save();
    }

    //Lekérdezések

    /* public function studentDatas()
    {
        return DB::table('students')
            ->select('student_id', 'email', 'nev')
            ->get();
    } */

    //Ez generálja a jsont
    public function studentDatasJsonba()
    {
        $students = DB::table('students as s')
            ->join('mail_senders as ms', 's.student_id', '=', 'ms.kod')
            ->select('s.student_id', 's.email', 's.nev', 'ms.fajlNev') //, 'p.path'
            ->get();

        $timestamp = now()->format('Y-m-d_H-i');
        $jsonFileName = 'studentEmailData_' . $timestamp . '.json';

        $jsonContent = json_encode($students);
        Storage::put('/jsonScriptek/' . $jsonFileName, $jsonContent);

        return $students;
    }

    public function uploadCsvRR(Request $request)
    {

        dd($request->all());

        $request->validate([
            'file' => 'required|mimes:csv,txt|max:10240',
        ]);

        if ($request->file('file')->isValid()) {
            $file = $request->file('file');


            $csvData = array_map('str_getcsv', file($file->path()));
            $csvData = array_slice($csvData, 1); // Fejléc kihagyásaF
            foreach ($csvData as $row) {
                DB::table('students')->insert([
                    'nev' => $row[0],
                    'student_id' => $row[1],
                    'email' => $row[2],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return response()->json(['message' => 'CSV fájl sikeresen feltöltődött'], 200);
        }

        return response()->json(['message' => 'Nem érvényes CSV fájl'], 400);
    }


    /* public function uploadCsv1(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:10240', // Max 10MB file size
        ]);

        if ($request->file('file')->isValid()) {
            $file = $request->file('file');
            $filePath = $file->getPathname();


            $handle = fopen($filePath, 'r');
            $header = fgetcsv($handle); //FEJLÉC LEVÉTELE
            while (($row = fgetcsv($handle)) !== false) {
                $data = array_combine($header, $row);
                $student = new Student();
                $student->student_id = $data['Bérlap kód'];
                $student->email = $data['Email'];
                $student->nev = $data['Név'];
                $student->save();
            }
            fclose($handle);

            return response()->json(['message' => 'CSV fájl sikeresen feltöltődött'], 200);
        }

        return response()->json(['message' => 'Nem érvényes CSV fájl'], 400);
    }
*/
    public function uploadCsv(Request $request)
    {
        // Validate the uploaded file        
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:10240', // Max 10MB file size
        ]);

        if ($request->file('file')->isValid()) {
            $file = $request->file('file');
            $filePath = $file->getPathname();

            $csvData = array_map('str_getcsv', file($filePath));
            $csvData = array_slice($csvData, 1);

            foreach ($csvData as $row) {
                DB::table('students')->insert([
                    'student_id' => $row[0],
                    'email' => $row[3],
                    'nev' => $row[4],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return response()->json(['message' => 'CSV fájl sikeresen feltöltődött'], 200);
        }

        return response()->json(['message' => 'Nem érvényes CSV fájl'], 400);
    }
}
