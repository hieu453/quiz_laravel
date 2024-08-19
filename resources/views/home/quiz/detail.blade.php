@extends('home.app')
@section('content')
  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            Đăng nhập để làm bài
            </div>
            <div class="modal-footer">
                <a href="{{ route('login') }}" class="btn btn-primary">Đăng nhập</a>
                <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">Đăng ký</a>
            </div>
        </div>
    </div>
</div>
<h1>Quiz title</h1>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
@if (Auth::check())
<a href="{{ route('quiz.start', ['id' => $quiz->id]) }}" class="btn btn-primary">Bắt đầu làm bài</a>
@else
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Bắt đầu làm bài
</button>
@endif

<div class="row d-flex justify-content-center">
        <div class="col-md-8 col-lg-6">
          <div class="card shadow-0 border" style="background-color: #f0f2f5;">
            <div class="card-body p-4">
              <div class="form-outline mb-4">
                <input
                  type="text"
                  id="addANote"
                  class="form-control"
                  placeholder="Type comment..."
                />
                <label class="form-label" for="addANote">+ Add a note</label>
              </div>

              <div class="card mb-4">
                <div class="card-body">
                  <p>Type your note, and hit enter to add it</p>

                  <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row align-items-center">
                      <img
                        src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(4).webp"
                        alt="avatar"
                        width="25"
                        height="25"
                      />
                      <p class="small mb-0 ms-2">Martha</p>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                      <p class="small text-muted mb-0">Upvote?</p>
                      <i
                        class="far fa-thumbs-up mx-2 fa-xs text-black"
                        style="margin-top: -0.16rem;"
                      ></i>
                      <p class="small text-muted mb-0">3</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card mb-4">
                <div class="card-body">
                  <p>Type your note, and hit enter to add it</p>

                  <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row align-items-center">
                      <img
                        src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(32).webp"
                        alt="avatar"
                        width="25"
                        height="25"
                      />
                      <p class="small mb-0 ms-2">Johny</p>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                      <p class="small text-muted mb-0">Upvote?</p>
                      <i
                        class="far fa-thumbs-up mx-2 fa-xs text-black"
                        style="margin-top: -0.16rem;"
                      ></i>
                      <p class="small text-muted mb-0">4</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card mb-4">
                <div class="card-body">
                  <p>Type your note, and hit enter to add it</p>

                  <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row align-items-center">
                      <img
                        src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(31).webp"
                        alt="avatar"
                        width="25"
                        height="25"
                      />
                      <p class="small mb-0 ms-2">Mary Kate</p>
                    </div>
                    <div class="d-flex flex-row align-items-center text-primary">
                      <p class="small mb-0">Upvoted</p>
                      <i class="fas fa-thumbs-up mx-2 fa-xs" style="margin-top: -0.16rem;"></i>
                      <p class="small mb-0">2</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-body">
                  <p>Type your note, and hit enter to add it</p>

                  <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row align-items-center">
                      <img
                        src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(32).webp"
                        alt="avatar"
                        width="25"
                        height="25"
                      />
                      <p class="small mb-0 ms-2">Johny</p>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                      <p class="small text-muted mb-0">Upvote?</p>
                      <i
                        class="far fa-thumbs-up ms-2 fa-xs text-black"
                        style="margin-top: -0.16rem;"
                      ></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
</div>
@endsection
