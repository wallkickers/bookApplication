<?php

declare(strict_types=1);

namespace packages\UseCase\User\Get;

use packages\UseCase\User\UserModel;

class UserGetResponse
{
    public UserModel $user;

    public function __construct(UserModel $userModel)
    {
        $this->user = $userModel;
    }
}
