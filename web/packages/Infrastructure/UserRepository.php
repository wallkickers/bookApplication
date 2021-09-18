<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Models;

use Illuminate\Support\Facades\DB;
use packages\Domain\Domain\Models\User;
use packages\Domain\Domain\Models\UserRepositoryInterface;

/**
 * ユーザーリポジトリインターフェース
 * @package packages\Domain\Domain\Models
 * @method mixed get()
 * @method User find(int $id)
 * @method User create(string $name, string $email, string $password, int $company_id)
 * @method User update(int $id, string $name, string $email, string $password, int $company_id)
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function get(): mixed
    {
        $users = DB::table('users')->get();
        return $users;
    }

    /**
     * @inheritdoc
     */
    public function find(int $id): User
    {
        $user = DB::table('users')->where('id', $id)->first();
        return new User(
            $id,
            $user->name,
            $user->email,
            $user->password,
            $user->company_id,
        );
    }

    /**
     * @inheritdoc
     */
    public function create(string $name, string $email, string $password, int $company_id): User
    {
        $user = DB::table('users')->create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'company_id' => $company_id,
        ]);
        return new User(
            $user->id,
            $user->name,
            $user->email,
            $user->password,
            $user->company_id,
        );
    }

    /**
     * @inheritdoc
     */
    public function update(int $id, string $name, string $email, string $password, int $company_id): User
    {
        $user = DB::table('users')->where('id', $id)->first();
        $user->update([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'company_id' => $company_id,
        ]);
        return new User(
            $user->id,
            $user->name,
            $user->email,
            $user->password,
            $user->company_id,
        );
    }
}
