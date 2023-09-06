@foreach($sub_comments as $sub_comment)
    <details class="comment-box">
        <summary>
            <span>{{ $sub_comment->message}}</span>,
            <span>{{ $sub_comment->date }}</span>,
            <span>{{ $sub_comment->name }}</span>
            <a class="button" href="{{ url('comments/reply') }}/{{ $post->id }}/{{ $sub_comment->cid }}">Reply</a>
        </summary>
        @php($sc = \App\utils\CommentController::sub_comments($sub_comment->postId, $sub_comment->cid))
        @if (count($sc))
            @include('Comments\sub_comment_list', ['sub_comments' => $sc])
        @endif
    </details>
@endforeach
