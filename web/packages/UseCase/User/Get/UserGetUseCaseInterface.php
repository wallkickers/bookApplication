<?php

declare(strict_types=1);

namespace packages\UseCase\User\Get;

interface UserGetUseCaseInterface
{
    /**
     * @param UserGetRequest $request
     * @return UserGetResponse
     */
    public function handle(UserGetRequest $request): UserGetResponse;
}
