@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">書籍貸し出し</div>
                <div class="card-body center">
                    <p>貸し出し完了</p>
                    <a href='{{ route('books.index') }}' class='btn-sticky'>書籍一覧へ戻る</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
