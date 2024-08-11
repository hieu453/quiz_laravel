<?php

namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;

class QuestionImport implements ToModel
{
    public function __construct(
        private int $quizId
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
        return new Question([
            'title' => $row[0],
            'quiz_id' => $this->quizId,
        ]);
    }
}
