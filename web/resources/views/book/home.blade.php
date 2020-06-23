@extends('layouts.app')

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

                    <form method="GET" action="{{ route('books.search') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="keyword" @isset($keyword) value="{{$keyword}}" @endisset class="form" placeholder="カタカナ検索">
                            <button type="submit" value="検索" class="">検索</button>
                        </div>
                    </form>

                    <table class='table'>
                        <tr>
                          <th>書籍番号</th>
                          <th>名前</th>
                          <th>貸し出し状況</th>
                        </tr>
                        @foreach ($books as $book)
                        <tr>
                          <td>{{ $book->id }}</td>
                          <td><a href='{{ route('books.show', ['book' => $book->id, 'isbn' => $book->isbn]) }}'>{{ $book->book_name }}</td>
                          @if ($book->user_id)
                          <td>貸し出し中</td>
                          @else
                          <td>-</td>
                          @endif
                        </tr>
                        @endforeach
                    </table>
                    {{ $books->appends(request()->input())->links() }}
                </div>
            </div>

            <div class="fh5co-narrow-content">
                <div class="row animate-box" data-animate-effect="fadeInLeft">
                    @foreach ($books as $book)
                        {{-- <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 work-item">
                            <a href='{{ route('books.show', ['book' => $book->id, 'isbn' => $book->isbn]) }}'>
                                <img src="images/work_1.jpg" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive">
                                <h3 class="fh5co-work-title"><a href='{{ route('books.show', ['book' => $book->id, 'isbn' => $book->isbn]) }}'>{{ $book->book_name }}</h3>
                                @if ($book->user_id)
                                    <p>貸し出し中</td>
                                @endif
                            </a>
                        </div> --}}
                        <book-card-component
                            isbn="{{ $book->isbn }}"
                        >
                            <template v-slot:book-link>
                                <p class="fh5co-work-title"><a href='{{ route('books.show', ['book' => $book->id, 'isbn' => $book->isbn]) }}'>{{ $book->book_name }}</p>
                            </template>
                        </book-card-component>
                    @endforeach
                    <div class="clearfix visible-md-block"></div>
                </div>
                {{ $books->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
