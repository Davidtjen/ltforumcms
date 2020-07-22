@extends('layouts.blog2')

@section('title')
    {{ $post->title }}
@endsection

@section('content')

    <!-- Main Content -->
    <main class="main-content">

        <!--
          |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
          | Blog content
          |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
          !-->
        <div class="section">
            <div class="container">

                <div class="text-center mt-6">
                    <h2>{{ $post->title }}</h2>
                    <p>
                        {{ Carbon\Carbon::parse($post->published_at)->toFormattedDateString()}}
                        in <a href="#" class="">{{ $post->category->name }}</a>
                        by {{ $post->user->name }}
                        {{-- <img class="avatar avatar-sm ml-1" src="{{ Gravatar::src($post->user->email)}}" alt="..."> --}}
                    </p>
                </div>

                <div class="text-center my-6">
                    <img class="rounded-md" src="{{ asset('storage/'. $post->image) }}" alt="...">
                </div>


                <div class="row">
                    <div class="col-lg-8 mx-auto">

                        <p class="lead">{!! $post->content !!}</p>

                        {{-- <hr class="w-100px"> --}}

                        <div class="gap-xy-2 mt-6">
                            @foreach ($post->tags as $tag)
                                <a class="badge badge-pill badge-secondary" href="#">{{ $tag->name }}</a>
                            @endforeach
                            {{-- <a class="badge badge-pill badge-secondary" href="#">Record</a>
                            <a class="badge badge-pill badge-secondary" href="#">Progress</a>
                            <a class="badge badge-pill badge-secondary" href="#">Customers</a>
                            <a class="badge badge-pill badge-secondary" href="#">News</a> --}}
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!--
          |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
          | Comments
          |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
          !-->
        <div class="section bg-gray">
            <div class="container">

                <div class="row">
                    <div class="col-lg-8 mx-auto">

                        <div class="media-list">

                            @include('partials._comments_replies', ['comments' => $post->comments, 'post_id' => $post->id])

                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 mx-auto mt-2">

                        <h4>Add comment</h4>

                        <form method="post" action="{{ route('comments.store') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="comment_body" class="form-control"/>
                                <input type="hidden" name="post_id" value="{{ $post->id }}"/>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-warning" value="Add Comment"/>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>

    </main>

@endsection
