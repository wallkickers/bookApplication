@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">貸し出し中書籍一覧</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class='table'>
                        <tr>
                          <th>書籍番号</th>
                          <th>名前</th>
                        </tr>
                        @foreach ($books as $book)
                        <tr>
                          <td>{{ $book->id }}</td>
                          <td><a href='{{ route('books.show', ['book' => $book->id]) }}'>{{ $book->book_name }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
