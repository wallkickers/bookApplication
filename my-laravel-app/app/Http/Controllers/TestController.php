<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        $users = User::all();
        // dd($user );

        return view('welcome', ['location'=>$location, 'weather'=>$weather, 'users'=>$users]);
    }

    public function callAPI(string $url) {
        // $access_token = $requestParam['accesstoken'];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
        // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$access_token));

        // var_dump($curl);
        // dd($curl);

        $result = curl_exec($curl);
        // dd($result);

        curl_close($curl);

        // dd(json_decode($result,true));
        return json_decode($result,true);
    }
}
