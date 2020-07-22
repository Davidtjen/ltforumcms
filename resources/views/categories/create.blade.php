@extends('layouts.app')

@section('content')

    <div class="justify-content-center">

        <div class="card">
            <div class="card-header">Create Category</div>

            <div class="card-body">

                @include('partials.errors')

                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <button type="submit" style="color: white" class="btn btn-info">Save Category</button>
                    </div>

                </form>
            </div>
        </div>

    </div>

@endsection
