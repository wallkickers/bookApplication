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

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $query = User::query();
        $searchedUsers = $query
            ->where('name', 'LIKE', "%".$keyword."%")
            ->paginate(config('app.pagesize'));
            return view('admin.home', ['users' => $searchedUsers]);
    }

    public function index()
    {
        $users = User::paginate(config('app.pagesize'));
        return view('admin.home', ['users' => $users]);
    }

    public function show(Request $request)
    {
        $user = Auth::user();
        $userId = $request->user;
        $selectedUser = User::where('id', $userId)->first();
        $books = $selectedUser->books()->get();

        return view('admin.user.show',[
            'user' => $user,
            'selectedUser' => $selectedUser,
            'books' => $books
        ]);
    }

    public function destroy(Request $request)
    {
        $userId = $request->user;
        $deleteUser = User::find($userId);
        $deleteUser->delete();
        $users = User::paginate(config('app.pagesize'));
        return view('admin.home', ['users' => $users]);
    }
}
