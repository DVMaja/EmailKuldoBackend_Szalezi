<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'adoszam',
        'tajszam',
        'email',
        'nev',
        'szul_nev',
        'anyja_neve',
        'okt_azon',
        'major_id',
    ];
}
