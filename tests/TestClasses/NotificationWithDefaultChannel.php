<?php

namespace Spatie\SlackApiNotificationChannel\Tests\TestClasses;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Mockery as m;
use Spatie\SlackApiNotificationChannel\Messages\SlackMessage;

class NotificationWithDefaultChannel extends Notification
{
    public function toSlackApi($notifiable)
    {
        return (new SlackMessage)
            ->from('Ghostbot')
            ->image('http://example.com/image.png')
            ->content('Content')
            ->attachment(function ($attachment) {
                $timestamp = m::mock(Carbon::class);
                $timestamp->shouldReceive('getTimestamp')->andReturn(1234567890);
                $attachment->title('Laravel', 'https://laravel.com')
                    ->content('Attachment Content')
                    ->fallback('Attachment Fallback')
                    ->fields([
                        'Project' => 'Laravel',
                    ])
                    ->footer('Laravel')
                    ->footerIcon('https://laravel.com/fake.png')
                    ->markdown(['text'])
                    ->timestamp($timestamp);
            });
    }
}