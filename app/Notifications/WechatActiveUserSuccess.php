<?php

namespace App\Notifications;

use App\Channels\WechatChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class WechatActiveUserSuccess extends Notification
{
    use Queueable;

    protected $templateID = 'Y4upVeO9RLslLPofqicS108cfh7HEMjBuyjVe7tyomI';
    protected $user;
    protected $active;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $active)
    {
        $this->user   = $user;
        $this->active = $active;
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
        $app    = app('wechat.official_account');
        $active = $this->active;
        $user   = $this->user;
        if ($user->openid) {
            $app->template_message->send([
                'touser'      => $user->openid,
                'template_id' => $this->templateID,
                'url'         => route('wechat.share.clubactives', $active),
                'data'        => [
                    'first'    => [
                        'value' => '尊敬的用户，您已成功报名' . $active->name . '活动。',
                        'color' => '#FF0000',
                    ],
                    'keyword1' => $active->name,
                    'keyword2' => $active->start_date . '至' . $active->finish_date,
                    'keyword3' => $active->address,
                    'remark'   => '请准时参加，如有变动请及时联系我们的工作人员。',
                ],
            ]);
        }
    }

}
