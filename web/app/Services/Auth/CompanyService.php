<?php

namespace App\Services\Auth;

use App\Company;
use App\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CompanyService
{
    public function registerCompany($companyCode, $companyName, $adminName, $adminEmail, $password)
    {
        $companyID = DB::transaction(function () use ($companyCode, $companyName, $adminName, $adminEmail, $password) {
            $companyID = Company::create([
                'code' => $companyCode,
                'name' => $companyName
            ])->id;

            Admin::create([
                'name' => $adminName,
                'email' => $adminEmail,
                'password' => Hash::make($password),
                'company_id' => $companyID,
            ]);

            return $companyID;
        });

        return $companyID;
    }
}
