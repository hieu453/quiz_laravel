<form action="{{ route('quiz.store') }}" method="POST">
@csrf
<div class="modal fade" id="addQuizModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="exampleInputText" class="form-label">Quiz</label>
                <input type="text" name="title" class="form-control">
                <input type="hidden" name="has_questions" value="0">
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
