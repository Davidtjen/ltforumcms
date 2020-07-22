@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Discussions owned by this user
        </div>
        <div class="card-body">

            <!-- Users list in table -->
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Title</th>
                </tr>
                </thead>

                <tbody>
                @foreach($discussionsForThisUser as $discussionForThisUser)
                    <tr>
                        <td><strong>{{ $discussionForThisUser }}</strong></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
