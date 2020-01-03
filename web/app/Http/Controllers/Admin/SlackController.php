<?php

namespace App\Http\Controllers\Admin;

// require 'vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Slack;

class SlackController extends Controller
{
    public function index()
    {
        $slack = slack::find(1);
        return view('admin.slack.slack')
        ->with([
            'slack' => $slack,
            'message' => '',
        ]);
    }

    public function update(Request $request)
    {
        $slack = slack::find(1);
        $slack->update($request->all());

        return redirect(route('admin.slack'))
        ->with([
            'slack' => $slack,
            'message' => "更新が完了しました。",
        ]);
    }
}
