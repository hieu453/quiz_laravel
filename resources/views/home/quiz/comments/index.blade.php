<div class="card">
    <div class="card-body">
        <h3 class="text-center text-success">ItSolutionStuff.com</h3>
        <br/>
        <h2>{{ $quiz->title }}</h2>
        <hr />
        <h4>Display Comments</h4>
        <hr />

        <div class="comment-wrapper">
        @include('home.quiz.comments.comments', ['comments' => $comments])
        </div>

        <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-primary load-more-comments" type="button">Load More</button>
            </div>
        <hr />
        <h4>Add comment</h4>
        @if (Auth::check())
        <form method="POST" action="{{ route('comment.store') }}">
            @csrf
            <div class="form-group">
                <textarea class="form-control" name="message"></textarea>
                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}" />
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Add Comment" />
            </div>
        </form>
        @else
        <p><a href="{{ route('login') }}">Đăng nhập</a> để bình luận</p>
        @endif
    </div>
</div>

@push('javascript')
<script>
    const ENDPOINT = '{{ route('quiz.detail', ["id" => $quiz->id]) }}'
    let page = 1;
    const loadMoreButton = $('.load-more-comments')

    loadMoreButton.click(function () {
        page++;
        loadMore(page);
    })

    function loadMore() {
        $.ajax({
            url: ENDPOINT + "?page=" + page,
            datatype: "html",
            type: "GET",
            success: function (response) {
                if (response.html == '') {
                    loadMoreButton.remove()
                    return;
                }

                $(".comment-wrapper").append(response.html);
            }
        })
    }
</script>
@endpush
