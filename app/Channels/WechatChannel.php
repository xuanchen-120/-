<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class WechatChannel
{
    /**
     * 发送给定的通知
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWechat($notifiable);
    }
}
