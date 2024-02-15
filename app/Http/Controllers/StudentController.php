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

    public function studentDatasJsonba()
    {
        $students = DB::table('students as s')
            ->join('mail_senders as ms', 's.student_id', '=', 'ms.student_id')
            ->select('s.student_id', 's.email', 's.nev', 'ms.pdf_name') //, 'p.path'
            ->get();

        $timestamp = now()->format('Y-m-d_H-i');
        $jsonFileName = 'studentEmailData_' . $timestamp . '.json';

        $jsonContent = json_encode($students);
        Storage::put('/jsonScriptek/' . $jsonFileName, $jsonContent);

        return $students;
    }

    public function studentDataToDatabase()
    {
        try {
            $handle = fopen(public_path("mailDatas.csv"), 'r');
            if (!$handle) {
                throw new \Exception("Failed to open the CSV file.");
            }

            $lineNumber = 0;

            while (($line = fgetcsv($handle, 4096)) !== false) {
                $lineNumber++;
                if ($lineNumber === 1) {
                    continue; // Skip header row
                }

                if (count($line) < 3) {
                    // Log or handle invalid row
                    continue;
                }

                $student = new Student();
                $student->student_id = $line[1];
                $student->email = $line[2];
                $student->nev = $line[0];
                // You can set other attributes here if needed
                $student->save();
            }

            fclose($handle);

            return response()->json(['message' => 'Data inserted successfully'], 200);
        } catch (\Exception $e) {
            // Log error or handle exception
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
