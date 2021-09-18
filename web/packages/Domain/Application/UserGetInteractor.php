<?php

declare(strict_types=1);

namespace packages\Domain\Application;

use packages\Domain\Domain\Models\UserRepositoryInterface;

class UserGetInteractor
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UserGetRequest $request
     * @return UserGetResponse
     */
    public function handle(UserGetRequest $request): UserGetResponse
    {
        $userId = $request->get();
        $user = $this->userRepositoryInterface->get($userId);

        return new UserGetResponse($user->getId());
    }
}
