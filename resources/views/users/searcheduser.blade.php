@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Users
        </div>
        <div class="card-body">

            <!-- Search for users form -->
            <form class="form-inline mb-2 float-right" method="GET" action="{{route('searchuser')}}">
                @csrf
                <input class="form-control mr-2" name="searchuser" type="searchuser"
                       placeholder="Search user(s)"
                       aria-label="Search" value="{{ request()->query('searchuser') }}">
                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">
                    Search
                </button>
            </form>

            <!-- Users list in table -->
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Points</th>
                    <th>Discussions</th>
                    <th>Delete</th>
                </tr>
                </thead>

                <tbody>

                @foreach($users as $user)

                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->admin}}</td>
                        <td>{{$user->points}}</td>
                        <td>
                            @if($user->userHasDiscussion($user->id))
                                <a href="{{route('users.discussions', ['user_id'=>$user->id])}}"
                                   class="btn btn-sm btn-primary">View titles</a>
                            @else
                                <a href="#" class="btn btn-sm btn-success">No discussions</a>
                            @endif
                        </td>
                        <td>
                            @if($user->userHasDiscussion($user->id))
                                <button class="btn btn-sm btn-primary" type="submit">Cannot Delete *</button>
                            @else
                                <form action="{{route('users.destroy', ['user'=>$user->id])}}"
                                      method="post">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}

                                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <small>* first remove discussions before removing a user, use the view titles button, search for the discussion (left), view then remove.</small>
        </div>
    </div>
@endsection
