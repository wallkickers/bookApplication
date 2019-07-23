@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">詳細</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table border="1" width="100%">
                        <tr>
                          <td>書籍名</td>
                          <td>{{ $book->book_name }}</td>
                        </tr>
                        <tr>
                          <td>書籍名(カナ)</td>
                          <td>{{ $book->title_kana }}</td>
                        </tr>
                        <tr>
                          <td>サブタイトル</td>
                          <td>{{ $book->subtitle }}</td>
                        </tr>
                        <tr>
                          <td>サブタイトル（カナ）</td>
                          <td>{{ $book->subtitle_kana }}</td>
                        </tr>
                        <tr>
                          <td>ISBN</td>
                          <td>{{ $book->isbn }}</td>
                        </tr>
                        <tr>
                          <td>著者</td>
                          <td>{{ $book->author }}</td>
                        </tr>
                        <tr>
                          <td>著者（カナ）</td>
                          <td>{{ $book->author_kana }}</td>
                        </tr>
                        <tr>
                          <td>出版</td>
                          <td>{{ $book->publisher }}</td>
                        </tr>
                        <tr>
                          <td>URL</td>
                          @if (isset($book->url))
                            <td><a href="{{ $book->url }}" target="_blank">{{ $book->url }}</a></td>
                          @else
                            <td>{{ $book->url }}</td>
                          @endif
                        </tr>
                    </table>
                    @if (is_null($book->hasUserName()))
                      <p>借りているユーザー：{{ $book->hasUserName() }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
