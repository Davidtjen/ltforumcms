@extends('layouts.app')

@section('content')

    <div class="justify-content-center">

        <div class="card">
            <div class="card-header">

                {{ isset($post) ? 'Edit Post' : 'Create Post' }}

            </div>

            <div class="card-body">

                @include('partials.errors')

                <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    @if(isset($post))
                        @method('PUT')
                    @endif

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                               value="{{ isset($post) ? $post->title : ''}}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" cols="5"
                                  rows="5">{{ isset($post) ? $post->description : ''}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <input id="content" type="hidden" name="content"
                               value="{{ isset($post) ? $post->content : ''}}">
                        <trix-editor input="content"></trix-editor>
                    </div>
                    <div class="form-group">
                        <label for="published_at">Published at</label>
                        <input type="text" name="published_at" id="published_at" class="form-control"
                               value="{{ isset($post) ? $post->published_at : '' }}">
                    </div>
                    @if($tags->count() > 0)
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}"
                                            @if(isset($post))
                                            @if($post->hasTag($tag->id))
                                            selected
                                            @endif
                                            @endif
                                    >{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if(isset($post))
                        <div class="form-group">
                            <img src="{{ asset('storage/'.$post->image) }}" alt="" style="width: 25%;">
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        @if(isset($post) && $category->id == $post->category_id)

                                        selected

                                        @endif
                                >{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" style="color: white" class="btn btn-success">
                            {{ isset($post) ? 'Update' : 'Save Post'}}</button>
                    </div>

                </form>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        flatpickr('#published_at', {
            enableTime: true,
            enableSeconds: true
        })

        $(document).ready(function () {
            $('.tags-selector').select2();
        })
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endsection
