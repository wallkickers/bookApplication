<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // TODO: 未実装
    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $query = Book::query();
        $searchedBooks = $query
            ->where('title_kana', 'LIKE', "%".$keyword."%")
            ->paginate(config('app.pagesize'));
        return view('book.home')->with([
            'books' => $searchedBooks
        ]);
    }

    public function index()
    {
        $users = User::paginate(config('app.pagesize'));
        return view('admin.home', ['users' => $users]);
    }

    // TODO: 未実装
    public function destroy(Request $request)
    {
        $bookId = $request->book;
        $deleteBook = Book::find($bookId);
        $deleteBook->delete();

        $books = Book::paginate(config('app.pagesize'));

        return view('admin.book.index')->with([
            'books' => $books
        ]);
    }
}
