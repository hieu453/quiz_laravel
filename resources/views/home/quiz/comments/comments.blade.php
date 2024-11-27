@foreach($comments as $comment)
    <div id={{ $comment->id }} class="display-comment border border-info mb-3 px-3 py-3">
        <div class="d-flex">
            <div class="avatar rounded text-center"><i class="fa-regular fa-user"></i></div>
            <strong class="ms-2">{{ $comment->user->name }}</strong>
        </div>
        <p class="ms-2">{{ $comment->message }}</p>
        @if (Auth::check())
        <a
        class="text-decoration-none me-2"
        type="button"
        aria-expanded="false"
        data-bs-toggle="collapse"
        href="#collapseComment{{ $comment->id }}"
        >
        <i class="fa-regular fa-comment-dots"></i>
        Trả lời
        </a>
        @endif

        @if ($comment->replies()->exists())
            <a
            class="text-decoration-none me-2"
            type="button"
            aria-expanded="false"
            data-bs-toggle="collapse"
            href="#collapseReplies{{ $comment->id }}"
            >
            <i class="fa-solid fa-caret-down"></i>
            Hiển thị câu trả lời
            </a>
        @endif

        @if (Auth::check())
            @if (Auth::user()->id == $comment->user->id)
                <a
                    data-mdb-dropdown-init class="text-decoration-none"
                    type="button"
                    id="dropdownMenuicon"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                >
                <i class="fa-solid fa-ellipsis-vertical"></i>
                Tùy chọn
                </a>
                <div class="dropdown">
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" data-bs-toggle="collapse" href="#collapseCommentEdit{{ $comment->id }}">Sửa</a></li>
                        <li><a class="dropdown-item text-danger" href="#">Xóa</a></li>
                    </ul>
                </div>
            @endif

            {{-- Form Edit Comment --}}
            <div class="collapse" id="collapseCommentEdit{{ $comment->id }}">
                <form method="POST" action="{{ route('comment.update', ['id' => $comment->id]) }}">
                    @csrf
                    <div class="form-group">
                        <textarea name="message" class="form-control"></textarea>
                        <input type="hidden" name="quiz_id" value="{{ $comment->quiz->id }}" />
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    </div>

                    <div class="form-group mt-2">
                        <input type="submit" class="btn btn-warning" value="Sửa" />
                        <a class="btn btn-danger" data-bs-toggle="collapse" href="#collapseCommentEdit{{ $comment->id }}">Đóng</a>
                    </div>
                </form>
            </div>

            {{-- Form Reply Comment --}}
            <div class="collapse" id="collapseComment{{ $comment->id }}">
                <form method="POST" action="{{ route('comment.store') }}">
                    @csrf
                    <div class="form-group">
                        <textarea name="message" class="form-control"></textarea>
                        <input type="hidden" name="quiz_id" value="{{ $comment->quiz->id }}" />
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    </div>

                    <div class="form-group mt-2">
                        <input type="submit" class="btn btn-warning" value="Reply" />
                        <a class="btn btn-danger" data-bs-toggle="collapse" href="#collapseComment{{ $comment->id }}">Đóng</a>
                    </div>
                </form>
            </div>
        @endif
    </div>

    @if ($comment->replies()->exists())
        <div class="collapse" id="collapseReplies{{ $comment->id }}">
            @foreach ($comment->replies as $reply)
                @if ($reply->parent_id == $comment->id)
                    <div id="{{ $reply->id }}" class="display-comment ms-5 border-start border-info mb-3 px-3 py-1">
                        <div class="d-flex">
                            <div class="avatar rounded text-center"><i class="fa-regular fa-user"></i></div>
                            <strong class="ms-2">{{ $reply->user->name }}</strong>
                        </div>
                        <p class="ms-2">{{ $reply->message }}</p>
                        @if (Auth::check())
                            @if (Auth::user()->id == $reply->user->id)
                                <a
                                    data-mdb-dropdown-init class="text-decoration-none"
                                    type="button"
                                    id="dropdownMenuicon"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                Tùy chọn
                                </a>
                                <div class="dropdown">
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" data-bs-toggle="collapse" href="#collapseReplyEdit{{ $reply->id }}">Sửa</a></li>
                                        <li><a class="dropdown-item text-danger" href="#">Xóa</a></li>
                                    </ul>
                                </div>
                            @endif

                        {{-- Form edit reply comment --}}
                        <div class="collapse" id="collapseReplyEdit{{ $reply->id }}">
                            <form method="POST" action="{{ route('comment.update', ['id' => $reply->id]) }}">
                                @csrf
                                <div class="form-group">
                                    <textarea name="message" class="form-control"></textarea>
                                    <input type="hidden" name="quiz_id" value="{{ $comment->quiz->id }}" />
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                </div>

                                <div class="form-group mt-2">
                                    <input type="submit" class="btn btn-warning" value="Sửa" />
                                    <a class="btn btn-danger" data-bs-toggle="collapse" href="#collapseReplyEdit{{ $reply->id }}">Đóng</a>
                                </div>
                            </form>
                        </div>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    @endif
@endforeach


