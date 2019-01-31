@extends('layouts.app')

@section('content')
    @if (session('errorMessage'))
        <div class="alert alert-danger" role="alert">
            {{ session('errorMessage') }}
        </div>
    @endif
    @if (session('confirmMessage'))
        <div class="alert alert-success" role="alert">
            {{ session('confirmMessage') }}
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <li><a href="{{ route('lang', ['en']) }}">En</a></li>
                            <li><a href="{{ route('lang', ['es']) }}">Es</a></li>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
