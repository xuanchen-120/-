<?php

namespace App\Notifications;

use App\Channels\WechatChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class WechatVipPassSuccess extends Notification
{
    use Queueable;

    protected $templateID = '4bUDpo4N6JuImDENCz_grqHlu-EtLnDobYEEbcE2aXs';
    protected $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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
        $app  = app('wechat.official_account');
        $user = $this->user;
        if ($user->openid) {
            $app->template_message->send([
                'touser'      => $user->openid,
                'template_id' => $this->templateID,
                'url'         => '',
                'data'        => [
                    'first'    => [
                        'value' => '恭喜您成功开通SVS业务引荐俱乐部VIP会员。',
                        'color' => '#FF0000',
                    ],
                    'keyword1' => 'SVS业务引荐俱乐部VIP会员',
                    'keyword2' => '一年',
                    'keyword3' => '￥3600.00',
                    'keyword4' => $user->vip_ended_at->toDateTimeString(),
                    'remark'   => '欢迎您访问SVS业务引荐俱乐部，体验更多VIP会员服务',
                ],
            ]);
        }
    }
}
