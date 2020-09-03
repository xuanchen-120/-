<?php

namespace App\Facades\Sms;

use Carbon\Carbon;
use Overtrue\EasySms\EasySms;

class SmsFactory
{

    protected $config;

    protected $error;

    /**
     * 单个用户 * 分钟 发送一条
     * @var integer
     */
    protected $frequency = 1;

    const REGISTER = 'register';
    const LOGIN    = 'login';
    const FINDPASS = 'findpass';

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * [发送方法]
     * @Author:<C.Jason>
     * @Date:2018-06-06
     * @param [type] $mobile [description]
     * @return [type] [description]
     */
    public function send($mobile, $type = self::REGISTER)
    {
        switch ($type) {
            case self::REGISTER:
                $template = 'SMS_155220102';
                break;
            case self::LOGIN:
                $template = 'SMS_155220104';
                break;
            case self::FINDPASS:
                $template = 'SMS_155220101';
                break;
            default:
                return false;
                break;
        }

        $lastTime = SmsModel::where('mobile', $mobile)->orderBy('id', 'desc')->value('created_at');
        if (!empty($lastTime) && $lastTime->diffInMinutes(Carbon::now(), false) < $this->frequency) {
            $this->error = '操作过于频繁';
            return false;
        }

        try {
            $easySms = new EasySms($this->config);
            $code    = rand(1000, 9999);

            $easySms->send($mobile, [
                'content'  => '您的验证码为: ' . $code,
                'template' => $template,
                'data'     => [
                    'code' => $code,
                ],
            ]);

            SmsModel::create([
                'mobile' => $mobile,
                'code'   => $code,
            ]);

            return true;
        } catch (\Exception $exception) {
            $this->error = $exception->getException('aliyun')->getmessage();
            return false;
        }
    }

    /**
     * [校验方法]
     * @Author:<C.Jason>
     * @Date:2018-06-06
     * @param [type] $mobile [description]
     * @param [type] $code [description]
     * @return [type] [description]
     */
    public function verify($mobile, $code)
    {
        $verify = SmsModel::where('mobile', $mobile)->where('used', 0)->orderBy('id', 'desc')->first();
        if (!$verify) {
            return false;
        } elseif ($verify->code != $code) {
            return false;
        } else {
            $verify->used = 1;
            $verify->save();
            return true;
        }
    }

    public function getError()
    {
        return $this->error;
    }
}
