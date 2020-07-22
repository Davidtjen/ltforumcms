@extends('layouts.app')

@section('content')

    <div class="justify-content-center">

        <div class="card">
            <div class="card-header">
                Posts
                {{--@if($posts->hasTrashed($posts))--}}
                <a href="{{ route('posts.create') }}"
                   class="d-flex btn btn-success btn-sm float-right">
                    Add Post
                </a>
                {{--@endif--}}
            </div>

            <div class="card-body">

                @if($posts->count() > 0)

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    {{--{{ $post->image }}--}}
                                    <img src="{{ asset('storage/'. $post->image) }}" height="10%;" alt="">
                                </td>

                                <td>{{ $post->title }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $post->category->id) }}">
                                        {{ $post->category->name }}
                                    </a>
                                </td>
                                <td>
                                    @if($post->trashed())
                                        <form action="{{ route('restore-post', $post->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-info btn-sm text-light" type="submit">Restore
                                            </button>
                                        </form>

                                    @else
                                        <a class="btn btn-info btn-sm text-light"
                                           href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('posts.destroy', $post->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            {{ $post->trashed() ? 'Delete' : 'Trash'}}
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                @else
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h4 class="text-center">No Posts available. </h4>
                        </li>
                    </ul>
                @endif

            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">

                <form action="" method="post" id="deletePostForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center text-bold">
                                Are you sure you want to delete this post?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">No, Go back</button>
                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>

@endsection


