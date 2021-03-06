@extends('layouts.app_admin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">書籍登録</div>

                <div class="card-body">
                    <form action="{{ route('admin.import') }}" method="post" enctype="multipart/form-data" id="csvUpload">
                            <input type="file" value="ファイルを選択" name="csv_file">
                            @csrf
                            <button type="submit">インポート</button>
                    </form>
                    @if (session('message'))
                        <div class="">{{ session('message') }}</div>
                    @endif
                    @if (session('regist_book_count'))
                        <div class="">登録件数：{{ session('regist_book_count') }}件</div>
                    @endif
                    @error('csv_file')
                        <div class="">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>

@endsection