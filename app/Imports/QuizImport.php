<?php

namespace App\Imports;

use App\Models\Quiz;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class QuizImport implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;

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
            'title'         => $row['title'],
            'description'   => $row['description'],
            'category_id'   => $this->category_id,
            // 'has_questions' => 0
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => 'unique:quizzes'
        ];
    }
}
