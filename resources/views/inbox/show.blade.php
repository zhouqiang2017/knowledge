@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">对话列表</div>
                    <div class="card-body">
                        <form action="/inbox/{{ $dialogId }}/store" method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea name="body" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success pull-right">发送私信</button>
                            </div>
                        </form>
                        <div class="message-list">
                            @foreach($messages as $message)
                                <div class="media">
                                    <div class="media-left">
                                        <a href="">
                                            <img width="25" src="{{ $message->fromUser->avatar }}" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            <a href="">
                                                {{ $message->fromUser->name }}
                                            </a>
                                        </h4>
                                        <p>
                                            <a href="/inbox/{{ $message->dialog_id }}">
                                                {{ $message->body }}
                                                <span class="pull-right">{{ $message->created_at->format('Y-m-d') }}</span>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
