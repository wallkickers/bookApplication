@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">貸し出し履歴</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="GET" action="{{ route('users.search') }}">
                        <div class="form-group">
                            <input type="text" name="keyword" @isset($keyword) value="{{$keyword}}" @endisset  class="form" placeholder="名前検索">
                            <button type="submit" value="検索" class="">検索</button>
                        </div>
                    </form>

                    <table class="table">
                        <tr>
                          <th>書籍名</th>
                          <th>借りた人</th>
                          <th>貸出日付</th>
                          <th>返却日</th>
                        </tr>
                        @foreach ($rental_histories as $rental_history)
                        <tr>
                            @isset($rental_history->book)
                            <td>{{ $rental_history->book->book_name }}</td>
                            <td>{{ $rental_history->book->hasUserName() }}</td>
                            @else
                            <td>-</td>
                            <td>-</td>
                            @endisset
                          {{-- <td>{{ $rental_history->book->book_name }}</td> --}}
                          {{-- <td>{{ $rental_history->book->hasUserName() }}</td> --}}
                          <td>{{ $rental_history->rental_date }}</td>
                          <td>{{ $rental_history->return_date }}</td>
                        </tr>
                        @endforeach
                    </table>
                    {{ $rental_histories->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
