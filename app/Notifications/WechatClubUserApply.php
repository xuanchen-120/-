<?php

namespace App\Notifications;

use App\Channels\WechatChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class WechatClubUserApply extends Notification
{
    use Queueable;

    protected $templateID = 'zca_bRP_H03awoeEShuWguvUDwtnJAwoiw04GSj67DI';
    protected $user;
    protected $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $type)
    {
        $this->user = $user;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WechatChannel::class];
    }

    public function toWechat($notifiable)
    {
        $app     = app('wechat.official_account');
        $user    = $this->user;
        $type    = $this->type;
        $message = $type ? '审核通过' : '审核不通过';

        if ($user->openid) {
            $app->template_message->send([
                'touser'      => $user->openid,
                'template_id' => $this->templateID,
                'url'         => '',
                'data'        => [
                    'first'    => [
                        'value' => '您好，您提交的加入俱乐部申请已审核完毕。',
                        'color' => '#FF0000',
                    ],
                    'keyword1' => '申请加入俱乐部',
                    'keyword2' => $message,
                    'remark'   => $type ? now()->toDateString() : '请登录平台查看驳回原因',
                ],
            ]);
        }
    }
}
