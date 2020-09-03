<?php

namespace App\Http\Controllers;

use App\Events\VipPaid;
use App\Models\Payment;
use App\Models\VipPament;
use Illuminate\Http\Request;

class NotifyController extends Controller
{
    public function __construct()
    {

    }

    public function payment(Request $request)
    {
        $app = app('wechat.payment');

        return $app->handlePaidNotify(function ($message, $fail) {
            $payment          = Payment::where('trade_no', $message['out_trade_no'])->first();
            $payment->state   = 'SUCCESS';
            $payment->paid_at = $message['time_end'];
            $payment->save();
            $payment->order->paid();
            return true;
        });
    }

    public function vip(Request $request)
    {
        $app = app('wechat.payment');
        return $app->handlePaidNotify(function ($message, $fail) {
            $vip_payment          = VipPament::where('trade_no', $message['out_trade_no'])->first();
            $vip_payment->state   = 'SUCCESS';
            $vip_payment->paid_at = $message['time_end'];
            $vip_payment->save();
            event(new VipPaid($vip_payment));
            return true;
        });
    }
}
