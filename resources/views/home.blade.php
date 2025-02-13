@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="justify-content-center">

            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome to the LOBA-TECH Content Management System
                </div>
            </div>
        </div>
    </div>
@endsection
