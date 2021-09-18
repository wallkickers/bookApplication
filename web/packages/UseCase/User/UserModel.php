<?php

declare(strict_types=1);

namespace packages\UseCase\User;

class UserModel
{
    public int $id;
    public string $name;
    public string $email;
    public string $companyId;

    /**
     * UserModel constructor.
     * @param int $id
     * @param string $name
     * @param string $email
     * @param int $company_id
     */
    public function __construct(
        int    $id,
        string $name,
        string $email,
        int    $company_id,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->company_id = $company_id;
    }
}
