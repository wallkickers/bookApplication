<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('auth:admin');
        $this->userService = $userService;
    }

    /**
     * ユーザー検索
     */
    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $users = $this->userService
            ->searchByKeyword($keyword)
            ->paginate(config('app.pagesize'));
            return view('admin.home', compact('users', 'keyword'));
    }

    /**
     * ユーザー一覧
     */
    public function index()
    {
        $users = $this->userService
            ->getAllUsersOrderByIdAsc()
            ->paginate(config('app.pagesize'));
        return view('admin.home', compact('users'));
    }

    /**
     * ユーザー詳細
     */
    public function show(Request $request)
    {
        $user = Auth::user();
        $userId = $request->user;
        $selectedUser = $this->userService->findByUserId($userId);
        $books = $selectedUser->books()->get();

        return view('admin.user.show', compact('user', 'selectedUser', 'books'));
    }

    /**
     * ユーザー削除
     */
    public function destroy(Request $request)
    {
        $userId = $request->user;
        $this->userService->deleteByUserId($userId);

        return redirect()->route('admin.index');
    }
}
