<?php

namespace App\Imports;

use App\Models\Quiz;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class QuizImport implements ToModel
{
    public function __construct(
        private int $category_id
    )
    {

    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Quiz([
            'title'         => $row[0],
            'description'   => $row[1],
            'category_id'   => $this->category_id,
            'has_questions' => 0
        ]);
    }
}
