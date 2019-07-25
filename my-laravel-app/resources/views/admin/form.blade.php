@extends('layouts.app_admin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">利用ユーザー一覧</div>

                <div class="card-body">
                    <form action="{{ route('admin.import') }}" method="post" enctype="multipart/form-data" id="csvUpload">
                            <input type="file" value="ファイルを選択" name="csv_file">
                            @csrf
                            <button type="submit">インポート</button>
                        </form>

                        @if(Session::has('message'))
                        {{ session('message') }}
                        @endif
                        
                        {{-- @if (is_array($errors))
                        <div class="flushComment">
                            ・CSVインポートエラーが発生しました。以下の内容を確認してください。<br>
                            @if (count($errors['registration_errors']) > 0)
                                [対象のデータ：新規登録]
                                <ul>
                                @foreach ($errors['registration_errors'] as $line => $columns)
                                    @foreach ($columns as $error)
                                    <li>{{ $line }}行目：{{ $error }}</li>
                                    @endforeach
                                @endforeach
                                </ul>
                            @endif
                            @if (count($errors['update_errors']) > 0)
                                [対象のデータ：編集登録]<br>
                                <ul>
                                @foreach ($errors['update_errors'] as $line => $columns)
                                    @foreach ($columns as $error)
                                    <li>{{ $line }}行目：{{ $error }}</li>
                                    @endforeach
                                @endforeach
                                </ul>
                            @endif
                        </div>
                        @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection