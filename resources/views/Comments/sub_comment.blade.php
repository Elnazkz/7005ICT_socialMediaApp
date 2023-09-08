@foreach($sub_comments as $sub_comment)
    {{--    @php($sc = \App\utils\CommentController::sub_comments($sub_comment->postId, $sub_comment->cid))--}}
    @if (count(\App\utils\CommentController::sub_comments($sub_comment->postId, $sub_comment->cid)))
        <details class="comment-box">
            <summary>
                <span>{{ $sub_comment->message}}</span>,
                <span>{{ $sub_comment->date }}</span>,
                <span>{{ $sub_comment->name }}</span>
                <a class="button" style="margin-left: 10px;"
                   href="{{ url('comments/reply') }}/{{ $post->id }}/{{ $sub_comment->cid }}">Reply</a>
            </summary>
            @if (count(\App\utils\CommentController::sub_comments($sub_comment->postId, $sub_comment->cid)))
                @include('Comments\sub_comment_list', ['sub_comments' => \App\utils\CommentController::sub_comments($sub_comment->postId, $sub_comment->cid)])
            @endif
        </details>
    @else
        <div class="comment-box">
            <span>{{ $sub_comment->message}}</span>,
            <span>{{ $sub_comment->date }}</span>,
            <span>{{ $sub_comment->name }}</span>
            <a class="button" style="margin-left: 10px;"
               href="{{ url('comments/reply') }}/{{ $post->id }}/{{ $sub_comment->cid }}">Reply</a>
        </div>
    @endif
@endforeach
