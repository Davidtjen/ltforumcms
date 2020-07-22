@extends('layouts.app')

@section('content')

    <div class="justify-content-center">

        <div class="card">
            <div class="card-header">Edit Tag</div>

            <div class="card-body">
                <form action="{{ route('tags.update', $tag->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{ $tag->name }}" id="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <button type="submit" style="color: white" class="btn btn-info">Update Tag</button>
                    </div>

                </form>
            </div>
        </div>

    </div>

@endsection
