<?php

namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;

class QuestionImport implements WithHeadingRow, OnEachRow, WithValidation
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
    // public function model(array $row)
    // {
    //     return new Question([
    //         'title' => $row['title'],
    //         'quiz_id' => $this->quizId,
    //     ]);
    // }

    public function rules(): array
    {
        return [
            'title' => 'unique:questions',
        ];
    }

    // public function customValidationMessages()
    // {
    //     return [
    //         'title.unique' => 'Trường :attribute đã tồn tại'
    //     ];
    // }

    public function onRow(Row $row)
    {
        $row      = $row->toArray(null, true);

        $question = Question::create([
            'title' => $row['title'],
            'quiz_id' => $this->quizId,
            'has_options' => 1
        ]);

        $options = [];
        $options[] = $row['option_1'];
        $options[] = $row['option_2'];
        $options[] = $row['option_3'];
        $options[] = $row['option_4'];

        foreach ($options as $option) {
            $question->options()->create([
                'text' => $option,
                'is_correct' => $option == $row['correct'] ? 1 : 0
            ]);
        }
    }
}
