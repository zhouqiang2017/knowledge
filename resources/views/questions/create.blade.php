@extends('layouts.app')
@section('css')
    {!! we_css() !!}
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">发布问题</div>
                    <div class="card-body">
                        <form action="/questions" method="POST">
                            @csrf
                            <label for="title">标 题</label>
                            <div class="form-group">
                                <input type="text" name="title" value="{{ old('title') }}" id="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="标题">
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('title') ? ' is-invalid' : '' }}">
                                {!! we_field('wangeditor', 'body', old('body')) !!}
                                @if ($errors->has('body'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button class="btn btn-success pull-right">发布问题</button>
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
