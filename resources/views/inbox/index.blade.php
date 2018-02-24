@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">私信列表</div>
                    <div class="card-body">
                        @foreach($messages as $key => $messageGroup)
                            <div class="media {{ $messageGroup->first()->shouldAddUnreadClass()? 'unread': '' }}">
                                <div class="media-left">
                                    <a href="">
                                        @if(Auth::id() == $key)
                                            <img width="25" src="{{ $messageGroup->first()->fromUser->avatar }}" alt="">
                                        @else
                                            <img width="25" src="{{ $messageGroup->first()->toUser->avatar }}" alt="">
                                        @endif
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        @if(Auth::id() == $key)
                                            {{ $messageGroup->first()->fromUser->name }}
                                        @else
                                            {{ $messageGroup->first()->toUser->name }}
                                        @endif
                                    </h4>
                                    <p><a href="/inbox/{{ $messageGroup->last()->dialog_id }}">{{ $messageGroup->last()->body }}</a></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
