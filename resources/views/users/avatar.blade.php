@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">更换头像</div>
                    <div class="card-body">
                        <user-avatar avatar="{{ user()->avatar }}"></user-avatar>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
