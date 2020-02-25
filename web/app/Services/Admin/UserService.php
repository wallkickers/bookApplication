<?php
namespace App\Services\Admin;

use App\User;

class UserService
{
    public function searchByKeyword($keyword)
    {
        return User::where('title_kana', 'LIKE', "%".$keyword."%");
    }

    public function getAllUsersOrderByIdAsc()
    {
        return User::orderBy('id', 'asc');
    }

    public function findByUserId($userId)
    {
        return User::find($userId);
    }

    public function deleteByUserId($userId)
    {
        $deleteUser = $this->findByUserId($userId);
        return $deleteUser->delete();
    }
}
