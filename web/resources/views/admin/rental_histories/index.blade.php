@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('view.RentalHistory') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="GET" action="{{ route('admin.rental_history') }}">
                        <div class="form-group">
                            <select name="display_item">
                                <option value="" @if($display_item=='') selected  @endif>{{ __('view.AllDisplay') }}</option>
                                <option value="not_return" @if($display_item=='not_return') selected  @endif>{{ __('view.NotReturn') }}</option>
                                <option value="return" @if($display_item=='return') selected  @endif>{{ __('view.Return') }}</option>
                            </select>
                            <button type="submit" value="表示" class="">{{ __('view.Display') }}</button>
                        </div>
                    </form>

                    <table class="table">
                        <tr>
                          <th>{{ __('view.BookTitle') }}</th>
                          <th>{{ __('view.RentalMember') }}</th>
                          <th>{{ __('view.RentalDate') }}</th>
                          <th>{{ __('view.ReturnDate') }}</th>
                        </tr>
                        @foreach ($rental_histories as $rental_history)
                        <tr>
                          <td>{{ $rental_history->book->book_name }}</td>
                          <td><a href='{{ route('admin.user.show', ['user' => $rental_history->user->id]) }}'>{{ $rental_history->user->name }}</td>
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
