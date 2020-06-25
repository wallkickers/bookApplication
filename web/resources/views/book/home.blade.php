@extends('layouts.app')

@section('content')
<div class="container">
    <div class="search-form">
        <form method="GET" action="{{ route('books.search') }}">
            @csrf
            <div class="form-group　search_container">
                <input type="text" name="keyword" size="25" @isset($keyword) value="{{$keyword}}" @endisset class="form search-input" placeholder="カタカナ検索">
                <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="fh5co-narrow-content">
                <div class="row animate-box" data-animate-effect="fadeInLeft">
                    @foreach ($books as $book)
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
