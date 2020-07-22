@extends('layouts.app')

@section('content')

    <div class="justify-content-center">

        <div class="card">
            <div class="card-header">Edit Category</div>

            <div class="card-body">
                <form action="{{ route('categories.update', $category->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{ $category->name }}" id="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <button type="submit" style="color: white" class="btn btn-info">Update Category</button>
                    </div>

                </form>
            </div>
        </div>

    </div>

@endsection
