<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bộ đề môn {{ $quiz->title }}</title>
</head>
<body>
    <div>
        <h1 style="text-align: center">Môn: {{ $quiz->title }}</h1>
        <div>
            @foreach($questions as $key => $question)
                <div id="question_{{ $key + 1 }}">
                    <h5>Câu {{ $key + 1 . ': ' . $question->title }}</h5>
                    @foreach($question->options as $option)
                        <div>
                            <input type="radio" {{ $option->is_correct == 1 ? 'checked' : '' }}>
                            <label>
                                {{ $option->text }}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
