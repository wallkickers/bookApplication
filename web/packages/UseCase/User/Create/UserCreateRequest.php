<?php

declare(strict_types=1);

namespace packages\UseCase\User\Get;

class UserCreateResponse
{
    private int $id;

    /**
     * ユーザーIDの取得
     * @return int
     */
    public function get(): int
    {
        return $this->id;
    }
}
