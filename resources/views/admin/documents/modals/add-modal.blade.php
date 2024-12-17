<form action="{{ route('document.store') }}" method="POST">
    @csrf
    <div class="modal fade" id="addDocumentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addModalLabel">Thêm tài liệu</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Môn học</label>
                    <select name="quiz_id" class="form-select">
                        @foreach($quizzes as $quiz)
                            <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Link youtube</label>
                    <input type="text" name="youtube_link" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Link tài liệu</label>
                    <input type="text" name="document_link" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
              <button type="submit" class="btn btn-primary">Thêm</button>
            </div>
          </div>
        </div>
    </div>
</form>
