@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">書籍貸し出し申請</div>

                <div class="card-body center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class='table'>
                        <tr>
                          <td>書籍名</td>
                          <td>{{ $book->book_name }}</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td></td>
                        </tr>
                    </table>

                <form action='{{ route('application.store', ['book' => $book->id]) }}' method='POST'>
                    @csrf
                    <div class="button_wrapper">
                        <button type="submit" class='btn-sticky center'>申請</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
