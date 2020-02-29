<?php

namespace App\Http\Controllers\Admin;

// require 'vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\Slack\SlackService;

class SlackController extends Controller
{
    private $slackService;

    public function __construct(SlackService $slackService)
    {
        $this->slackService = $slackService;
    }

    public function index()
    {
        $slack = $this->slackService->find(1);
        return view('admin.slack.slack')
        ->with([
            'slack' => $slack,
            'message' => '',
        ]);
    }

    public function update(Request $request)
    {
        $slack = $this->slackService->update(1, $request);
        return redirect(route('admin.slack'))
        ->with([
            'slack' => $slack,
            'message' => "更新が完了しました。",
        ]);
    }
}
