@extends('layouts.app')

@section('content')

    <div class="justify-content-center">

        <div class="card">
            <div class="card-header">
                Tags
                <a href="{{ route('tags.create') }}"
                   class="d-flex btn btn-success btn-sm float-right">
                    Add Tag
                </a>
            </div>
            <div class="card-body">
                @if($tags->count() > 0)
                    <ul class="list-group">
                        @foreach($tags as $tag)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong>{{ $tag->name }} </strong>
                                            </div>
                                            <div class="col-md-6">
                                                Number of posts: {{ $tag->posts->count() }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-1 float-right">
                                        <a href="{{ route('tags.edit', $tag->id) }}" style="color: white"
                                           class="btn btn-info btn-sm float-right ">
                                            Edit
                                        </a>
                                    </div>
                                    <div class="col-md-1 float-right">
                                        <button onclick="handleDelete({{ $tag->id }})"
                                                class="btn btn-danger btn-sm float-right">
                                            Delete
                                        </button>

                                        {{--<form action="{{ route('categories.destroy', $category->id) }}"--}}
                                        {{--method="post">--}}
                                        {{--@csrf--}}
                                        {{--@method('DELETE')--}}
                                        {{--<button onclick="handleDelete({{ $category->id }})" type="submit"--}}
                                        {{--class="btn btn-danger btn-sm float-right">--}}
                                        {{--Delete--}}
                                        {{--</button>--}}
                                        {{--</form>--}}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else

                    <ul class="list-group">
                        <li class="list-group-item">
                            <h4 class="text-center">No Tags available.</h4>
                        </li>
                    </ul>

                @endif
            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">

                <form action="" method="post" id="deleteTagForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Tag</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center text-bold">
                                Are you sure you want to delete this tag?
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

@section('scripts')
    <script>
        function handleDelete(id) {
            var form = document.getElementById('deleteTagForm')
            form.action = '/tags/' + id
            $('#deleteModal').modal('show')
        }
    </script>
@endsection
