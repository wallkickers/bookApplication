@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">利用ユーザー一覧</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('users.search') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="keyword" class="form" placeholder="名前検索">
                            <button type="submit" value="検索" class="">検索</button>
                        </div>
                    </form>

                    <table class="table">
                        <tr>
                          <th>書籍番号</th>
                          <th>名前</th>
                          <th>貸し出し状況</th>
                          <th>削除</th>
                        </tr>
                        @foreach ($users as $user)
                        <tr>
                          <td>{{ $user->id }}</td>
                          <td><a href='{{ route('admin.user.show', ['user' => $user->id]) }}'>{{ $user->name }}</td>
                          <td>{{ $user->hasBooksNum() }}</td>
                          @if ($user->hasBooksNum() === 0)
                          <td>
                            <form method="POST" name='deleteUser' action='{{ route('admin.user.destroy', ['user' => $user->id])}}'>
                              @csrf
                              @method('DELETE')
                              <button type="submit">削除</button>
                            </form>
                          </td>
                          @else
                          <td>
                              -
                          </td>
                          @endif
                        </tr>
                        @endforeach
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
