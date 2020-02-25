<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\Admin\UserService;

class UserController extends Controller
{
    private $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->middleware('auth:admin');
        $this->userService = $userService;
    }

    // searchはGETメソッドで行う。
    // 検索単語は持ち回る
    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $searchedUsers = $this->userService
            ->searchByKeyword($keyword)
            ->paginate(config('app.pagesize'));
            return view('admin.home', ['users' => $searchedUsers]);
    }

    public function index()
    {
        $users = $this->userService
            ->getAllUsersOrderByIdAsc()
            ->paginate(config('app.pagesize'));
        return view('admin.home', ['users' => $users]);
    }

    public function show(Request $request)
    {
        $user = Auth::user();
        $userId = $request->user;
        $selectedUser = $this->userService
            ->findByUserId($userId);
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
        $result = $this->userService
            ->deleteByUserId($userId);
        return redirect()->route('admin.index');
    }
}
