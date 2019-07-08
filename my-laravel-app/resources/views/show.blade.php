@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <p>書籍名：{{ $book->book_name }}</p>
                @if (!isset($book->user_id))
                    <a href='{{ route('application.create', ['book' => $book->id]) }}'>貸し出し申請</button>                    
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
