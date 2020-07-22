@extends('layouts.app')

@section('content')
    <div class="card mb-2">
        <div class="card-header">

            <!-- Owner profile specs and points -->
            <img src="{{$d->user->profile->avatar}}" alt="" width="40px" height="40px">
            &nbsp;&nbsp;
            <span><b>{{$d->user->name}}</b> <small>( {{$d->user->points }} )</small></span>

            <!-- Discussion options -->
            @if(Auth::check())
                @if(Auth::user()->admin)
                    <form action="{{route('discussion.destroy', ['id'=> $d->id])}}"
                          method="post">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button type="submit" class="btn btn-danger btn-sm float-right ml-1">
                            Delete
                        </button>
                    </form>
                @endif
            @endif
            @if(Auth::id() == $d->user->id)
                @if(!$d->hasBestAnswer())
                    <a href="{{route('discussion.edit',['slug'=> $d->slug])}}"
                       class="btn btn-secondary float-right btn-sm ml-1">Edit</a>
                @endif
            @endif

            <!-- Discussion status -->
            @if($d->hasBestAnswer())
                <span class="text-danger float-right btn-sm ml-1">closed</span>
            @else
                <span class="text-secondary float-right btn-sm ml-1">open</span>
            @endif
            @if($d->is_being_watched_by_auth_user())
                <a href="{{route('discussion.unwatch',['id'=> $d->id ])}}"
                   class="btn btn-outline-secondary float-right btn-sm ml-1">unfollow</a>
            @else
                <a href="{{route('discussion.watch',['id'=> $d->id ])}}"
                   class="btn btn-outline-secondary float-right btn-sm">follow</a>
            @endif

            {{--@if(Auth::check())--}}
            {{--@if(Auth::user()->admin)--}}
            {{--<button onclick="handleDelete({{ $category->id }})"--}}
            {{--class="btn btn-danger btn-sm float-right">--}}
            {{--Delete--}}
            {{--</button>--}}
            {{--@endif--}}
            {{--@endif--}}

        </div>

        <div class="card-body">
            <div class="text-center">
                <h4>
                    <b>{{$d->title}}</b>
                </h4>

            </div>
            <hr>
            <p>{!! Markdown::convertToHtml($d->content) !!}</p>
        </div>

        @if($best_answer)

            <hr>

            <h4 class="text-center">BEST ANSWER</h4>
            <div class="text-center" style="padding: 1rem">
                <div class="card">
                    <div class="card-header">
                        <img src="{{$best_answer->user->profile->avatar}}" alt="" width="40px" height="40px">
                        &nbsp;&nbsp;
                        <span><b>{{$best_answer->user->name}}</b> <small>( {{$best_answer->user->points }}
                                )</small></span>
                    </div>
                    <div class="card-body">
                        {!! Markdown::convertToHtml($best_answer->content) !!}
                    </div>
                </div>
            </div>

        @endif

        <div class="card-footer">
            <div class="row">
                <div class="col-md-6">
                    <p>
                        {{$d->replies->count()}} Replies
                    </p>
                </div>
                <div class="col-md-6">
                    <a href="{{route('channel',['slug'=>$d->channel->slug])}}"
                       class="btn btn-light btn-sm float-right">{{$d->channel->title}}</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Replies --}}
    @foreach($d->replies as $r)
        <div class="card">
            <div class="card-header">

                <img src="{{$r->user->profile->avatar}}" alt="" width="40px" height="40px">
                &nbsp;&nbsp;
                <span><b>{{$r->user->name}}</b> <small>( {{$r->user->points }} )</small></span>

                @if(Auth::id() == $r->user->id)
                    @if(!$r->best_answer)
                        <a href="{{route('reply.edit',['id' => $r->id ])}}"
                           class="btn btn-sm btn-secondary float-right ml-1">Edit</a>
                    @endif
                @endif

                @if(!$best_answer)
                    @if(Auth::id() == $d->user->id)
                        <a href="{{route('discussion.best.answer',['id' => $r->id ])}}"
                           class="btn btn-sm btn-light float-right">Mark as best answer</a>
                    @endif
                @endif

            </div>

            <div class="card-body">
                <p>{!! Markdown::convertToHtml($r->content) !!}</p>
            </div>
            <div class="card-footer">
                @if($r->is_liked_by_auth_user())
                    <a href="{{ route('reply.unlike', ['id'=>$r->id ]) }}" class="btn btn-secondary btn-sm">
                        Unlike
                        <span class="badge">{{$r->likes->count()}}</span>
                    </a>
                @else
                    <a href="{{ route('reply.like',['id'=> $r->id ]) }}" class="btn btn-outline-primary btn-sm">
                        Like
                        <span class="badge">{{$r->likes->count()}}</span>
                    </a>
                @endif
            </div>
        </div>
    @endforeach


    <div class="card">
        <div class="card-body">

            @if(Auth::check())
                @if(Auth::user()->email_verified_at == 0)
                    <div class="text-center">
                        <h5>Verify your email address to leave a reply.</h5>
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        <br>
                        {{ __('If you did not receive the email') }},
                        <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                    </div>
                @else
                    <form action="{{route('discussions.reply', ['id'=>$d->id])}}" method="post">
                        {{csrf_field()}}

                        <div class="form-group">
                            {{--<label for="reply">Leave your reply here ...</label>--}}
                            <label for="reply">Care to share your thoughts ...</label>
                            <textarea name="reply" id="reply" cols="95" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn float-right">
                                Submit reply
                            </button>
                        </div>
                    </form>
                @endif
            @else
                <div class="text-center">
                    <h2>Sign in to leave a reply.</h2>
                </div>
            @endif

        </div>
    </div>

@endsection







