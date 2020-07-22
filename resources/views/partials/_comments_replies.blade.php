@foreach($comments as $comment)

    <div class="media">

        <img class="avatar avatar-sm mr-4" src="{{ Gravatar::src($comment->user->email)}}"
             alt="...">

        <div class="media-body">

            <div class="small-1">
                <strong>{{ $comment->user->name }}</strong>
                <time class="ml-4 opacity-70 small-3">
                    {{ Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}
                </time>

                <div class="btn-sm btn-outline-secondary float-right comment_form_reply"
                     data-id="{{ $comment->id }}">
                    <span class="fa fa-reply"></span>
                </div>
            </div>

            <p class="small-2 mb-1">
                {{ $comment->body }}
            </p>

            <form id="comment_form_{{ $comment->id }}" class="comment_form_class" method="post" action="{{ route('reply.add') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="comment_body" class="form-control"/>
                    <input type="hidden" name="post_id" value="{{ $post->id }}"/>
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}"/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-warning" value="Reply"/>
                </div>
            </form>
            @include('partials._comments_replies', ['comments' => $comment->replies])
        </div>
    </div>

@endforeach

@section('scripts')
    <script>

        $(document).ready(function () {

            $('.comment_form_class').hide();
            // comment_form_class

            // change the selector to use a class
            $(".comment_form_reply").click(function () {
                // this will query for the clicked toggle
                var $toggle = $(this);

                // build the target form id
                var id = "#comment_form_" + $toggle.data('id');

                $(id).toggle();
            });
        });

    </script>
@endsection

{{--@foreach($comment->replies as $comment)--}}

{{--<div class="media col-md-10 float-right">--}}
{{--<img class="avatar avatar-sm mr-4"--}}
{{--src="{{ Gravatar::src($comment->user->email)}}"--}}
{{--alt="...">--}}

{{--<div class="media-body">--}}
{{--<div class="small-1">--}}
{{--<strong>{{ $comment->user->name }}</strong>--}}
{{--<div class="ml-4 opacity-70 small-3">--}}
{{--{{ Carbon\Carbon::parse($comment->published_at)->diffForHumans()}}--}}

{{--<span id="reply_form_reply" class="btn-sm btn-primary float-right">--}}
{{--Reply--}}
{{--</span>--}}
{{--</div>--}}
{{--</div>--}}
{{--<p class="small-2 mb-0">--}}
{{--{{ $comment->body }}--}}
{{--</p>--}}

{{--<form id="reply_form" method="post" action="{{ route('reply.add') }}">--}}
{{--@csrf--}}
{{--<div class="form-group">--}}
{{--<input type="text" name="comment_body" class="form-control"/>--}}
{{--<input type="hidden" name="post_id" value="{{ $post->id }}"/>--}}
{{--<input type="hidden" name="comment_id" value="{{ $comment->id }}"/>--}}
{{--</div>--}}
{{--<div class="form-group">--}}
{{--<input type="submit" class="btn btn-warning" value="Reply"/>--}}
{{--</div>--}}
{{--</form>--}}
{{--</div>--}}
{{--</div>--}}

{{--@endforeach--}}


{{--@foreach($comment->replies as $comment)--}}

{{--<div class="media col-md-10 float-right">--}}
{{--<img class="avatar avatar-sm mr-4"--}}
{{--src="{{ Gravatar::src($comment->user->email)}}"--}}
{{--alt="...">--}}

{{--<div class="media-body">--}}
{{--<div class="small-1">--}}
{{--<strong>{{ $comment->user->name }}</strong>--}}
{{--<div class="ml-4 opacity-70 small-3">--}}
{{--{{ Carbon\Carbon::parse($comment->published_at)->diffForHumans()}}--}}

{{--<span id="reply_form_reply" class="btn-sm btn-primary float-right">--}}
{{--Reply--}}
{{--</span>--}}
{{--</div>--}}
{{--</div>--}}
{{--<p class="small-2 mb-0">--}}
{{--{{ $comment->body }}--}}
{{--</p>--}}

{{--<form id="reply_form" method="post" action="{{ route('reply.add') }}">--}}
{{--@csrf--}}
{{--<div class="form-group">--}}
{{--<input type="text" name="comment_body" class="form-control"/>--}}
{{--<input type="hidden" name="post_id" value="{{ $post->id }}"/>--}}
{{--<input type="hidden" name="comment_id" value="{{ $comment->id }}"/>--}}
{{--</div>--}}
{{--<div class="form-group">--}}
{{--<input type="submit" class="btn btn-warning" value="Reply"/>--}}
{{--</div>--}}
{{--</form>--}}
{{--</div>--}}
{{--</div>--}}

{{--@endforeach--}}
