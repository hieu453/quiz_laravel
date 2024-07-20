<?php

namespace App\Imports;

use App\Models\Quiz;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class QuizImport implements ToModel, WithChunkReading, ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Quiz([
            'title' => $row[0],
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
