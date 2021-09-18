<?php

declare(strict_types=1);

namespace packages\Domain\Application;

use packages\Domain\Domain\Models\UserRepositoryInterface;

class UserCreateInteractor implements UserCreateUseCaseInterface
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
        $user = $this->userRepository->create(
            $request->getName(),
            $request->getEmail(),
            $request->getPassword(),
            $request->getCompanyId(),
        );

        return new UserGetResponse($user->getId());
    }
}
