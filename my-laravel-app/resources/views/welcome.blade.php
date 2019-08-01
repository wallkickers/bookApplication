@extends('layouts.app')

@section('content')
<div class="flex-center position-ref full-height welcome-ground">
        <div class="content">
                <div class="loading">
                        <span data-text="B">B</span>
                        <span data-text="O">O</span>
                        <span data-text="O">O</span>
                        <span data-text="K">K</span>
                        <span data-text="M">M</span>
                        <span data-text="A">A</span>
                        <span data-text="R">R</span>
                        <span data-text="K">K</span>
                </div>
            <a href='{{ route('books.index') }}' class='welcome-text'>はじめる</a>
        </div>
</div>
@endsection