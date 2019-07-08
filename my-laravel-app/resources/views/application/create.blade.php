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

                <form action='{{ route('application.store') }}' method='POST'>
                    @csrf
                    <label>お名前：</label><input type="text" name='full_name'>
                    <button type="submit">申請</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
