@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">書籍一覧</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- <form class="form-inline" action="">
                        <div class="form-group">
                            <input type="text" name="keyword" class="form-control" placeholder="カタカナ検索">
                        </div>
                        <input type="submit" value="検索" class="">
                    </form> --}}

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
                          <td>
                          <form method="POST" name='deleteBook' action='{{ route('books.destroy', ['book' => $book->id])}}'>
                            @csrf
                            @method('DELETE')
                            <button type="submit">削除</button>
                          </form>
                        </td>
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
