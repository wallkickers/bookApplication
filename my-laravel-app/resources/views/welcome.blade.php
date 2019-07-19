@extends('layouts.app')

@section('content')
<div class="flex-center position-ref full-height">
        <div class="content">
            <p>WELCOME TO BookMark</p>
            <a href='{{ route('books.index') }}'>はじめる</a>
        </div>
</div>
@endsection