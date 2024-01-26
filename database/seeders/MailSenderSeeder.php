<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class MailSenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LazyCollection::make(function () {
            $handle = fopen(public_path("mailDatas.csv"), 'r');

            while (($line = fgetcsv($handle, 4096)) !== false) {
                $dataString = implode(", ", $line);
                $row = explode(';', $dataString);
                yield $row;
            }

            fclose($handle);
        })
            ->skip(1)
            ->chunk(1000)
            ->each(function (LazyCollection $chunk) {
                $records = $chunk->map(function ($row) {
                    return [

                        "nev" => $row[0],
                        "student_id" => $row[1],
                        "email" => $row[2],
                        "pdf_name" => $row[3],
                    ];
                })->toArray();

                DB::table('mail_senders')->insert($records);
            });
    }
}
