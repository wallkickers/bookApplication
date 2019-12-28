@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">通知設定</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.slack.update') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Slack Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $slack->name ?? old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="icon" class="col-md-4 col-form-label text-md-right">Slack Icon</label>
                            <div class="col-md-6">
                                <input id="icon" type="text" class="form-control @error('icon') is-invalid @enderror" name="icon" value="{{ $slack->icon ?? old('icon') }}" required autocomplete="icon" autofocus>
                                @error('icon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="channel" class="col-md-4 col-form-label text-md-right">Slack Channel</label>
                            <div class="col-md-6">
                                <input id="channel" type="text" class="form-control @error('channel') is-invalid @enderror" name="channel" value="{{ $slack->channel ?? old('channel') }}" required autocomplete="channel" autofocus>
                                @error('channel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="url" class="col-md-4 col-form-label text-md-right">Slack URL</label>
                            <div class="col-md-6">
                                <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ $slack->url ?? old('url') }}" required autocomplete="url" autofocus>
                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    設定
                                </button>
                            </div>
                        </div>
                        <p>{{ $message }}</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
