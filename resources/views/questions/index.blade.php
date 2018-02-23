@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    @foreach($questions as $question)
                        <div class="media">
                            <div class="media-left">
                                <a href="">
                                    <img width="30" src="{{ $question->user->avatar }}" alt="{{ $question->user->name }}">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="/questions/{{ $question->id }}">
                                        {{ $question->title }}
                                    </a>
                                </h4>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('questions.create') }}" class="btn btn-success btn-block">发布问题</a>
            </div>
        </div>
    </div>
@endsection
