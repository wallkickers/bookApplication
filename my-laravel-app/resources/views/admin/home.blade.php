@extends('layouts.app_admin')

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
                    

                    <table border="1" width="100%">
                        <tr>
                          <th>書籍番号</th>
                          <th>名前</th>
                          <th>貸し出し状況</th>
                        </tr>
                        @foreach ($books as $book)
                        <tr>
                          <td>{{ $book->id }}</td>
                          <td><a href='{{ route('books.show', ['book' => $book->id]) }}'>{{ $book->book_name }}</td>
                          @if ($book->user_id)
                          <td>貸し出し中</td>
                          @else
                          <td>-</td>
                          @endif
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
