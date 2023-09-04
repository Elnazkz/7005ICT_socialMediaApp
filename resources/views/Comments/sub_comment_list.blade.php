@foreach($sub_comments as $sub_comment)
    <ul>
        <div class="comment-box">
            <li>
                <span>{{ $sub_comment->message}}</span>,
                <span>{{ $sub_comment->date }}</span>,
                <span>{{ $sub_comment->name }}</span>
            </li>
        </div>
        @php
            $sc = App\Http\Controllers\CommentController::sub_comments($sub_comment->postId, $sub_comment->cid);
        @endphp
        @if (count($sc))
            @include('Comments\sub_comment_list', ['sub_comments' => $sc])
        @endif
    </ul>
@endforeach
