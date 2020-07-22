@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header text-center">How can we support you?</div>

        <div class="card-body">
            <form method="post" action="{{ route('contactformstore') }}">
                {{csrf_field()}}

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{old('email')}}" class="form-control">
                </div>

                {{--<div class="form-group">
                    <label for="channel">Pick a Channel</label>
                    <select name="channel_id" id="channel_id" class="form-control">
                        @foreach($channels as $channel)
                            <option value="{{$channel->id}}">{{$channel->title}}</option>
                        @endforeach
                    </select>
                </div>--}}

                <div class="form-group">
                    <label for="message">Ask a question</label>
                    <textarea class="form-control form-control-sm" name="message" id="message" cols="95"
                              rows="5">{{old('message')}}</textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success pull-right">Send</button>
                </div>

            </form>
        </div>
    </div>
@endsection
