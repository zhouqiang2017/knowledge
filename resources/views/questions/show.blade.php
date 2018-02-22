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
            <div class="col-md-3">
                <div class="card card-default">
                    <div class="card-header text-center">
                        <h2>{{ $question->followers_count }}</h2>
                        <span>关注者</span>
                    </div>
                    @if(Auth::check())
                        <div class="card-body text-center">
                            <question-follow-button question="{{ $question->id }}"></question-follow-button>
                            <a href="#editor" class="btn btn-primary pull-right">撰写答案</a>
                        </div>
                    @endif
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
                                    <user-vote-button answer="{{ $answer->id }}" count="{{$answer->votes_count}}"></user-vote-button>
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
                        @if(Auth::check())
                            <form action="/question/{{ $question->id }}/answer" method="POST" id="editor">
                                @csrf
                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    {!! we_field('wangeditor', 'body', old('body')) !!}
                                    @if ($errors->has('body'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <button class="btn btn-success pull-right">提交答案</button>
                            </form>
                        @else
                            <a href="{{ url('login') }}" class="btn btn-success btn-block">登录提交答案</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-default  padding-b-15">
                    <div class="card-header text-center">
                        <h5>关于作者</h5>
                    </div>
                    <div class="card-body text-center">
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img width="30" src="{{ $question->user->avatar }}"
                                             alt="{{ $question->user->name }}">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="#">
                                            {{ $question->user->name }}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                            <div class="user-statics">
                                <div class="statics-item text-center">
                                    <div class="statics-text">问题</div>
                                    <div class="statics-count">{{ $question->user->questions_count }}</div>
                                </div>
                                <div class="statics-item text-center">
                                    <div class="statics-text">回答</div>
                                    <div class="statics-count">{{ $question->user->answers_count }}</div>
                                </div>
                                <div class="statics-item text-center">
                                    <div class="statics-text">关注者</div>
                                    <div class="statics-count">{{ $question->user->followers_count }}</div>
                                </div>
                            </div>
                            <user-follow-button user="{{ $question->user->id }}"></user-follow-button>
                            <send-message user="{{ $question->user->id }}"></send-message>
                        </div>
                </div>

            </div>
        </div>
@endsection
@section('js')
    {!! we_js() !!}
    {!! we_config('wangeditor') !!}
@endsection
