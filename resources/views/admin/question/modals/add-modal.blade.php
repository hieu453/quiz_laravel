<form action="{{ route('question.store') }}" method="POST">
@csrf
<div class="modal fade" id="addQuestionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Quiz</label>
                <select name="quiz_id" class="form-select">
                    @foreach($quizzes as $quiz)
                        <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Question</label>
                <input name="title" type="text" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
</div>
</form>
