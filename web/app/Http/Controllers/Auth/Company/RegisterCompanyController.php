<?php

namespace App\Http\Controllers\Auth\Company;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Services\Auth\CompanyService;
use CreateAdminsTable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterCompanyController extends Controller
{
    private $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }


    public function showRegisterCompanyForm()
    {
        return view('admin.register');
    }

    public function registerCompany(Request $request)
    {
        $this->companyService
            ->registerCompany(
                $request->company_code,
                $request->company_name,
                $request->admin_name,
                $request->admin_email,
                $request->password
            );
        return view('admin.login');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
