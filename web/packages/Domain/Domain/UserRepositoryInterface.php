<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Models;

use packages\Domain\Domain\Models\User;

/**
 * ユーザーリポジトリインターフェース
 * @package packages\Domain\Domain\Models
 * @method User get(int $id)
 * @method User create(string $name, string $email, string $password, int $company_id)
 */
interface UserRepositoryInterface
{
    /**
     * ユーザー一覧取得
     * @param int $id ユーザーID
     * @return mixed ユーザー
     */
    public function get(): mixed;

    /**
     * ユーザー取得
     * @param int $id ユーザーID
     * @return User ユーザー
     */
    public function find(int $id): User;

    /**
     * ユーザー作成
     * @param string $name ユーザー名
     * @param string $email Eメール
     * @param string $password パスワード
     * @param int $company_id 企業ID
     * @return User ユーザー
     */
    public function create(string $name, string $email, string $password, int $company_id): User;

    /**
     * ユーザー情報更新
     * @param int $id ユーザーID
     * @param string $name ユーザー名
     * @param string $email Eメール
     * @param string $password パスワード
     * @param int $company_id 企業ID
     * @return User ユーザー
     */
    public function update(int $id, string $name, string $email, string $password, int $company_id): User;
}
