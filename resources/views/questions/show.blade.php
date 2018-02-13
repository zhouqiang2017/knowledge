@extends('layouts.app')

@section('css')
    {!! we_css() !!}
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        {{ $question->title }}
                    @foreach($question->topics as $topic)
                        <a class="topic pull-right">{{ $topic->name }}</a>
                    @endforeach
                    </div>
                    <div class="card-body">
                        {!! $question->body !!}
                    </div>
                    <div class="actions">
                        @if(Auth::check() && Auth::user()->owns($question))
                            <span class="edit"><a href="/questions/{{ $question->id }}/edit">编 辑</a></span>
                            <form action="/questions/{{ $question->id }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button class="button is-naked delete-btn">删 除</button>
                            </form>
                        @endif
                    </div>
                </div> 
            </div>



            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        {{ $question->answers_count }}个答案
                    </div>

                    <div class="card-body">
                        @foreach($question->answers as $answer)
                            <div class="media">
                                <div class="media-left">
                                    <a href="">
                                        <img width="25" src="{{ $answer->user->avatar }}" alt="{{ $answer->user->name }}">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="/questions/{{ $answer->user->id }}">
                                            {{ $answer->user->name }}
                                        </a>
                                    </h4>
                                    {!! $answer->body !!}
                                </div>
                            </div>
                        @endforeach


                        <form action="/question/{{ $question->id }}/answer" method="POST">
                            @csrf
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                {!! we_field('wangeditor', 'body', old('body')) !!}
                                @if ($errors->has('body'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button class="btn btn-success pull-right">提交评论</button>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('js')
    {!! we_js() !!}
    {!! we_config('wangeditor') !!}
@endsection
