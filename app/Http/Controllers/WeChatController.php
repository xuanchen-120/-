<?php
namespace App\Http\Controllers;

use App\Http\WechatHandlers\EventMessageHandler;
use App\Http\WechatHandlers\FileMessageHandler;
use App\Http\WechatHandlers\ImageMessageHandler;
use App\Http\WechatHandlers\LinkMessageHandler;
use App\Http\WechatHandlers\LocationMessageHandler;
use App\Http\WechatHandlers\ShortVideoMessageHandler;
use App\Http\WechatHandlers\TextMessageHandler;
use App\Http\WechatHandlers\TransferMessageHandler;
use App\Http\WechatHandlers\VideoMessageHandler;
use App\Http\WechatHandlers\VoiceMessageHandler;
use EasyWeChat\Kernel\Messages\Message;
use Overtrue\LaravelWeChat\Controllers\Controller;

class WeChatController extends Controller
{

    public function serve()
    {
        $app = app('wechat.official_account');
        $app->server->push(TextMessageHandler::class, Message::TEXT);
        $app->server->push(ImageMessageHandler::class, Message::IMAGE);
        $app->server->push(VoiceMessageHandler::class, Message::VOICE);
        $app->server->push(VideoMessageHandler::class, Message::VIDEO);
        $app->server->push(ShortVideoMessageHandler::class, Message::SHORT_VIDEO);
        $app->server->push(LocationMessageHandler::class, Message::LOCATION);
        $app->server->push(LinkMessageHandler::class, Message::LINK);
        $app->server->push(FileMessageHandler::class, Message::FILE);
        $app->server->push(EventMessageHandler::class, Message::EVENT);
        $app->server->push(TransferMessageHandler::class, Message::TRANSFER);
        return $app->server->serve();
    }

    public function publish()
    {
        $app     = app('wechat.official_account');
        $buttons = [
            ["name" => '博海名品',
                "type"  => "view",
                "url"   => route('index.index'),
            ],
            ["name" => '个人中心',
                "type"  => "view",
                "url"   => route('user.index'),
            ],

        ];
        $res = $app->menu->create($buttons);
        return $res;
    }
}
