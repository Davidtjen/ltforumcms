@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">

            <span><b>{{$profile->user->name}} 's Profile</b></span>

        </div>

        <div class="card-body">
            <div class="text-center">

                <img src="{{$profile->avatar}}" alt="" width="100px" height="100px">
                &nbsp;&nbsp;

                <form action="{{ route('profiles.update', ['profile_id' => $profile->id] ) }}"
                      enctype="multipart/form-data" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <input type="file" name="avatar" id="avatar" placeholder="Upload avatar">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Save changes</button>
                    </div>

                </form>

                <hr>
                <span><b>Full Name: {{$profile->user->name}}</b></span>

                {{--<hr>--}}
                {{--<h4>--}}
                {{--<b>About: {{ $profile->about }}</b>--}}
                {{--</h4>--}}

            </div>
            {{--<hr>--}}
            {{--<p>--}}
            {{--<span><b>Facebook: {{ $profile->facebook }}</b></span>--}}
            {{--</p>--}}
            {{--<p>--}}
            {{--<span><b>Youtube: {{ $profile->youtube }}</b></span>--}}
            {{--</p>--}}
        </div>
        {{----}}
        {{--<hr>--}}
        {{----}}
        {{--<div class="card-footer">--}}
        {{--<div class="row">--}}
        {{--<div class="col-md-6">--}}
        {{--<p>--}}
        {{--{{$d->replies->count()}} Replies--}}
        {{--</p>--}}
        {{--</div>--}}
        {{--<div class="col-md-6">--}}
        {{--<a href="{{route('channel',['slug'=>$d->channel->slug])}}"--}}
        {{--class="btn btn-light btn-sm float-right">{{$d->channel->title}}</a>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}

    </div>


@endsection







