@extends('layouts.app')

@section('content')

    @foreach($discussions as $d)

        <div class="card mb-2">
            <div class="card-header">

                <img src="{{$d->user->profile->avatar}}" alt="" width="40px" height="40px">
                &nbsp;&nbsp;
                <span><b>{{$d->user->name}}</b>, <small>{{$d->created_at->diffForHumans()}}</small></span>
                 @if($d->hasBestAnswer())
                    <span class="text-danger float-right btn-sm ml-1">closed</span>
                @else
                    <span class="text-secondary float-right btn-sm ml-1">open</span>
                @endif
                <a href="{{route('discussions', ['slug'=>$d->slug])}}" class="btn btn-outline-secondary float-right btn-sm">View</a>
            </div>

            <div class="card-body">
                <div class="text-center">
                    <h4>
                        <b>{{$d->title}}</b>
                    </h4>

                    <p>{{str_limit($d->content, 50)}}</p>
                </div>

            </div>
            <div class="card-footer">
                <p>
                    {{$d->replies->count()}} Replies
                </p>
            </div>
        </div>

    @endforeach

    <div class="text-center">
        {{ $discussions->links() }}
    </div>


@endsection
