<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Models;

class User
{
    // ユーザーID
    private int $id;
    // ユーザー名
    private string $name;
    // Eメール
    private string $email;
    // パスワード
    private string $password;
    // 企業ID
    private int $company_id;

    public function __construct(
        int    $id,
        string $name,
        string $email,
        string $password,
        int    $company_id,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->company_id = $company_id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return int
     */
    public function getCompanyId(): int
    {
        return $this->company_id;
    }
}
