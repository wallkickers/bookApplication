<?php

declare(strict_types=1);

namespace App\Services\Admin;

use App\User;
use Illuminate\Database\Eloquent\Builder;

class UserService
{
    public function searchByKeyword(string $keyword): Builder
    {
        return User::where('name', 'LIKE', "%".$keyword."%");
    }

    public function getAllUsersOrderByIdAsc(): Builder
    {
        return User::orderBy('id', 'asc');
    }

    public function findByUserId(int $userId): User
    {
        return User::find($userId);
    }

    public function deleteByUserId($userId)
    {
        $deleteUser = $this->findByUserId($userId);
        return $deleteUser->delete();
    }
}
