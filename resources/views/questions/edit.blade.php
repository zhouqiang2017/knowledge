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
                        <form action="/questions/{{ $question->id }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <label for="title">标 题</label>
                            <div class="form-group">
                                <input type="text" name="title" value="{{ $question->title }}" id="title"
                                       class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                       placeholder="标题">
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <select class="js-example-placeholder-multiple js-data-example-ajax form-control"
                                        name="topics[]" multiple="multiple">
                                    @foreach($question->topics as $topic)
                                        <option value="{{ $topic->id }}" selected="selected">{{ $topic->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group{{ $errors->has('title') ? ' is-invalid' : '' }}">
                                {!! we_field('wangeditor', 'body', $question->body) !!}
                                @if ($errors->has('body'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button class="btn btn-success pull-right">修改问题</button>
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
    <script>
        $(document).ready(function () {
            function formatTopic(topic) {
                return "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" +
                topic.name ? topic.name : "Laravel" +
                    "</div></div></div>";
            }

            function formatTopicSelection(topic) {
                return topic.name || topic.text;
            }

            $(".js-example-placeholder-multiple").select2({
                tags: true,
                placeholder: '选择相关话题',
                minimumInputLength: 2,
                ajax: {
                    url: '/api/topics',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function (data, params) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                templateResult: formatTopic,
                templateSelection: formatTopicSelection,
                escapeMarkup: function (markup) {
                    return markup;
                }
            });
        });
    </script>
@endsection
