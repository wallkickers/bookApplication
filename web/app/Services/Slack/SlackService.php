<?php
namespace App\Services\Slack;

use App\Slack;
use Illuminate\Notifications\Notifiable;
use App\Notifications\SlackNotification;

class SlackService
{
    use Notifiable;

    public function send($message = null, $attachment = null)
    {
        $this->notify(new SlackNotification($message, $attachment));
    }

    protected function routeNotificationForSlack()
    {
        $slack = Slack::find(1);
        $slack_url = $slack->url ?? env('SLACK_URL');
        return $slack_url;
    }

    public function find($slackId)
    {
        return slack::find($slackId);
    }

    public function update($slackId, $request)
    {
        $slack = $this->find($slackId);
        $slack->update($request->all());
    }
}
