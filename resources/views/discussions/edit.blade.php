@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header text-center">Update a Discussion</div>

        <div class="card-body">
            <form action="{{route('discussion.update', ['id'=>$discussion->id])}}" method="post">
                {{csrf_field()}}

                <div class="form-group">
                    <label for="content">As a question</label>
                    <textarea class="form-control form-control-sm" name="content" id="content" cols="95"
                              rows="5">{{$discussion->content}}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success pull-right">Save Discussion Changes</button>
                </div>

            </form>
        </div>
    </div>
@endsection
