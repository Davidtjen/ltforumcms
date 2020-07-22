@extends('layouts.app')

@section('content')

    @foreach($discussions as $d)

        <div class="card mb-2">

            <div class="card-header">
                <!-- Discussion owner specs -->
                <img src="{{$d->user->profile->avatar}}" alt="" width="40px" height="40px">
                &nbsp;&nbsp;
                <span><b>{{$d->user->name}}</b> <small>( {{$d->user->points }} )</small></span>
                @if($d->hasBestAnswer())
                    <span class="text-danger float-right btn-sm ml-1">closed</span>
                @else
                    <span class="text-secondary float-right btn-sm ml-1">open</span>
                @endif
                <a href="{{route('discussions', ['slug'=>$d->slug])}}"
                   class="btn btn-outline-secondary float-right btn-sm ml-1">View</a>
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

    @endforeach

    <div class="text-center">
        <ul class="pagination">
            <li class="page-item">
                {{ $discussions->links() }}
            </li>
        </ul>
    </div>

@endsection
