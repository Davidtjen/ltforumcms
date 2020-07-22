@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header text-center">Create a new Discussion</div>

        <div class="card-body">
            <form action="{{route('discussions.store')}}" method="post">
                {{csrf_field()}}

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="title" name="title" value="{{old('title')}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="channel">Pick a Channel</label>
                    <select name="channel_id" id="channel_id" class="form-control">
                        @foreach($channels as $channel)
                            <option value="{{$channel->id}}">{{$channel->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="content">Ask a question</label>
                    <textarea class="form-control form-control-sm" name="content" id="content" cols="95" rows="5">{{old('content')}}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success pull-right">Create Discussion</button>
                </div>

            </form>
        </div>
    </div>
@endsection
